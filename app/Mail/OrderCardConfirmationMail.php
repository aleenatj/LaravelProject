<?php

namespace App\Mail;

use App\Models\OrderCard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class orderCardConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderCard;

    /**
     * Create a new message instance.
     */
    public function __construct(OrderCard $orderCard)
    {
        $this->orderCard = $orderCard;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Gift Card Confirmation Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.gift_card_confirmation',
            with: [
                'orderCard' => $this->orderCard,
            ],
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
