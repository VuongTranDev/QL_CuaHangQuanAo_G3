<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class XacNhanDonHang extends Mailable
{
    use Queueable, SerializesModels;
    private $emailParams;
    /**
     * Create a new message instance.
     */
    public function __construct($params)
    {
        $this->emailParams = $params;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác nhận đặt hàng',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.xacnhandonhang',
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
    public function build()
    {
        $this->from(Config::get('app.senderEmail'),Config::get('app.senderName'))
        ->subject($this->emailParams->subject)
        ->view('emails.xacnhandonhang')
        ->with(['emailParams' => $this->emailParams]);
        return $this->view('emails.xacnhandonhang');
    }
}
