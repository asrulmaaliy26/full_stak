<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $replySubject;
    public $replyContent;
    public $schoolName;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $content, $jenjang = 'UMUM')
    {
        $this->replySubject = $subject;
        $this->replyContent = $content;
        
        $names = [
            'TK' => 'TK Al Hidayah',
            'MI' => 'MI Al Hidayah',
            'SMPT' => 'SMPT Al Hidayah',
            'MA' => 'MA Al Hidayah',
            'MADIN' => 'MADIN Al Hidayah',
            'TPQ' => 'TPQ Al Hidayah',
            'KAMPUS' => 'STAI Al Mannan',
            'UMUM' => 'LPI Al Hidayah'
        ];
        
        $this->schoolName = $names[strtoupper($jenjang)] ?? 'LPI Al Hidayah';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->replySubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reply',
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
