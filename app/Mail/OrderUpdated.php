<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderUpdated extends Mailable
{
    use Queueable, SerializesModels;

    private Order $order;
    private $email;
    private $name;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $email, $name)
    {
        $this->order = $order;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->name),
            subject: 'Order ' . $this->order->status,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            htmlString: "<p>Your order " . $this->order->id . " transferred to status "
                . $this->order->status . "</p>>",
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
