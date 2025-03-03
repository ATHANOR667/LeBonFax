<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Collab extends Mailable
{
    use Queueable, SerializesModels;

    public  string $name;
    public  string $sujet;
    public  string $content;
    public string $pays ;
    public string $contact ;

    /**
     * Create a new content instance.
     */
    public function __construct($name , $sujet, $content , $pays , $contact )
    {
        $this->name = $name;
        $this->sujet = $sujet;
        $this->content = $content;
        $this->pays = $pays;
        $this->contact = $contact;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle Proposition de Partenariat',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.collab',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
