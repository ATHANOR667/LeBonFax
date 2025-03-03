<?php


namespace App\Console\Commands;

use App\Mail\CertifInvoice;
use App\Mail\PackInvoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\CinetPayService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class verifyPayment extends Command
{
    protected $signature = 'app:verify-payment';
    protected $description = 'Vérifie les paiements en attente avec le service CinetPay';

    public function handle(): void
    {
        try {
            $this->processPendingPayments();
        } catch (\Exception $e) {
            Log::error('Erreur globale du commande : ' . $e->getMessage());
            $this->error('Erreur critique : ' . $e->getMessage());
        }
    }

    private function processPendingPayments(): void
    {
        $payments = Payment::where('status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinutes(1))
            ->cursor();

        if ($payments->isEmpty()) {
            $this->info('Aucun paiement en attente trouvé.');
            return;
        }

        foreach ($payments as $payment) {
            $this->handlePayment($payment);
        }

        $this->info('Traitement des paiements terminé.');
    }

    private function handlePayment(Payment $payment): void
    {
        try {
            $result = (new CinetPayService())->checkPayment(
                $payment->transaction_id,
                $payment->token
            );

            $this->updatePaymentStatus($payment, $result);
        } catch (\Exception $e) {
            Log::error("Erreur paiement {$payment->id}: " . $e->getMessage());
            $this->error("Erreur traitement paiement {$payment->id}: " . $e->getMessage());
        }
    }

    private function updatePaymentStatus(Payment $payment, array $result): void
    {
        if ($result['code'] === '00') {
            $this->markPaymentCompleted($payment, $result);
        } else {
            $this->markPaymentFailed($payment, $result);
        }
    }

    private function markPaymentCompleted(Payment $payment, array $result): void
    {
        $payment->update([
            'status' => 'completed',
            'methode' => $result['data']['payment_method'],
            'devise' => $result['data']['currency'],
            'dateDisponibilite' => $result['data']['fund_availability_date']
        ]);

        $this->dispatchEmailJob($payment);
        $this->info("Paiement {$payment->transaction_id} complété. Email en file d'attente.");
    }

    private function markPaymentFailed(Payment $payment, array $result): void
    {
        $payment->update([
            'status' => 'failed',
            'motif' => $result['message']
        ]);

        $this->error("Échec paiement {$payment->transaction_id}: {$result['message']}");
    }

    private function dispatchEmailJob(Payment $payment): void
    {
        try {
            if ($payment->email) {
                $mailable = $payment->certif_id
                    ? new CertifInvoice($payment)
                    : new PackInvoice($payment);

                Mail::to($payment->email)->queue($mailable);
            }
        } catch (\Exception $e) {
            Log::error("Erreur envoi email {$payment->id}: " . $e->getMessage());
            $this->error("Erreur envoi email {$payment->id}: " . $e->getMessage());
        }
    }
}
