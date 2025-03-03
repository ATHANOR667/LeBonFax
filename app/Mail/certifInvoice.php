<?php

namespace App\Mail;

use App\Models\Certif;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class certifInvoice extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Payment $payment;
    public Certif $certif;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->certif = $payment->certif;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Facture LeBonFax - ' . $this->certif->nom,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Mail.certifInvoice',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('Mail.Attachment.certif-invoice', [
            'payment' => $this->payment,
            'certif' => $this->certif
        ]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn() => $pdf->output(),
                'Facture-LeBonFax-' . $this->payment->transaction_id . '.pdf',
                ['mime' => 'application/pdf']
            )
        ];
    }
}
