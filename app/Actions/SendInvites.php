<?php

namespace App\Actions;

use App\Models\Event;
use App\Models\Invite;

class SendInvites
{
    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function execute(): void
    {
        $this->event->invites()
            ->each(function (Invite $invite) {
                if (!$invite->is_invite_sent) {
                    (new SendInvite($invite))->execute();
                }
            });
    }
}
