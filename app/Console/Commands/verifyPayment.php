<?php

namespace App\Console\Commands;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\CinetPayService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class verifyPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifie les paiements en attente avec le service CinetPay';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $payments = Payment::where('status', 'pending')
                ->where('created_at', '<=', Carbon::now()->subMinutes(10))
                ->get();

            if ($payments->isEmpty()) {
                $this->info('Aucun paiement en attente trouvé.');
                return;
            }

            foreach ($payments as $payment) {
                $transID = $payment->transaction_id;
                $token = $payment->token;

                $cinetPay = new CinetPayService();
                $result = $cinetPay->checkPayment($transID, $token);

                if ($result['code'] == '00') {
                    $payment->status = 'completed';
                    $payment->methode = $result['data']['payment_method'];
                    $payment->devise = $result['data']['currency'];
                    $payment->dateDisponibilite = $result['data']['fund_availability_date'];
                    $payment->save();
                    $this->info("Paiement {$transID} vérifié et marqué comme complété.");
                } elseif ($result['code'] == '627' && $result['message'] == 'TRANSACTION_CANCEL') {
                    $payment->status = 'failed';
                    $payment->motif = $result['message'];
                    $payment->save();
                    $this->error("Paiement {$transID} échoué : Transaction annulée.");
                } else {
                    $payment->status = 'failed';
                    $payment->motif = $result['message'];
                    $payment->save();
                    $this->error("Paiement {$transID} échoué : {$result['message']}");
                }
            }

            $this->info('Les paiements ont été vérifiés avec succès.');

        } catch (GuzzleException $e) {
            Log::error('Erreur lors de la vérification du paiement : ' . $e->getMessage());
            $this->error('Erreur lors de la communication avec le service de paiement : ' . $e->getMessage());
        } catch (\Exception $exception) {
            Log::error('Erreur lors de la vérification du paiement : ' . $exception->getMessage());
            $this->error('Erreur lors de la vérification du paiement : ' . $exception->getMessage());
        }
    }
}
