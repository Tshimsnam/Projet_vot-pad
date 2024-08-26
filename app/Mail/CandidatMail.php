<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidatMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $coupon;
    public $date;
    public $noms;
    public $heure;
    public $isVote;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $coupon, $date, $noms, $heure, $isVote)
    {
        $this->subject = $subject;
        $this->coupon = $coupon;
        $this->date = $date;
        $this->noms = $noms;
        $this->heure = $heure;
        $this->isVote = $isVote;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->isVote == 1) {
            return new Content(
                view: 'mails.vote',
                with: [
                    'date' => $this->date,
                    'email' => $this->noms,
                    'heure' => $this->heure,
                ],
            );
        } else {
            return new Content(
                view: 'mails.coupon',
                with: [
                    'coupon' => $this->coupon,
                    'date' => $this->date,
                    'email' => $this->noms,
                    'heure' => $this->heure,
                ],
            );
        }
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
