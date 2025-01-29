<?php

namespace App\Mail;

use App\Models\Pack;
use Barryvdh\DomPDF\Facade ;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentFeedback extends Mailable
{
    use Queueable, SerializesModels;

    public Pack $pack;
    public string $reference;
    public string $nom;
    public string $prenom;

    /**
     * Create a new message instance.
     *
     * @param  Pack  $pack
     * @param  string  $reference
     * @param  string  $nom
     * @param  string  $prenom
     * @return void
     */
    public function __construct(Pack $pack, string $reference, string $nom, string $prenom)
    {
        $this->pack = $pack;
        $this->reference = $reference;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de Paiement',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_feedback',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Facade\Pdf::loadView('Mail.invoice', [
            'pack' => $this->pack,
            'reference' => $this->reference,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
        ]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromString(
                $pdf->output(),
                'facture_' . $this->reference . '.pdf',
                'application/pdf'
            )
        ];
    }
}
