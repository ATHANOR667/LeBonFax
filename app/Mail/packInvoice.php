<?php

namespace App\Mail;

use App\Models\Pack;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class packInvoice extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Payment $payment;
    public Pack $pack;
    public float $totalAvantReduction;
    public float $montantReduction;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->pack = $payment->pack;
        $this->totalAvantReduction = $this->pack->certifs->sum('prix');
        $this->montantReduction = $this->pack->prix;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation d\'achat du pack '.$this->pack->nom.' - LeBonFax',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mail.packInvoice',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('Mail.Attachment.pack-invoice', [
            'payment' => $this->payment,
            'pack' => $this->pack,
            'totalAvantReduction' => $this->totalAvantReduction,
            'montantReduction' => $this->montantReduction
        ]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn() => $pdf->output(),
                'Facture-Pack-'.$this->pack->id.'.pdf',
                ['mime' => 'application/pdf']
            )
        ];
    }
}
