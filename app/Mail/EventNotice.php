<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class EventNotice extends Mailable
{
    use Queueable, SerializesModels;

    public Invite $invite;
    public Event $event;
    public string $url;

    /**
     * Create a new message instance.
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
        $this->event = $invite->event()->getResults();
        $this->url = url("/invites/{$invite->id}");
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉  ' . $this->event->name . ' is happening tomorrow!',
        );
    }

    public function headers(): Headers
    {
        return new Headers(
            text: [
                'X-PM-Tag' => 'sm-notice'
            ]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.event-notice',
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
