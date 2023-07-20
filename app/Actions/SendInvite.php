<?php

namespace App\Actions;

use App\Mail\EventInvite;
use App\Models\Invite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendInvite
{
    public function __construct(
        public Invite $invite,
    ) {}

    public function execute(): void
    {
        try {
            Mail::to($this->invite)->send(new EventInvite($this->invite));
            $this->invite->is_invite_sent = true;
            $this->invite->save();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . "\n Failed for " . $this->invite->email);
        }
    }
}
