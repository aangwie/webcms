<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyMessage;
    public $originalMessage;
    public $subjectText;

    public function __construct(Message $originalMessage, string $subjectText, string $replyMessage)
    {
        $this->originalMessage = $originalMessage;
        $this->subjectText = $subjectText;
        $this->replyMessage = $replyMessage;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reply_message',
            with: [
                'replyMessage' => $this->replyMessage,
                'originalMessage' => $this->originalMessage,
            ]
        );
    }
}
