<?php

namespace App\Jobs;

use App\Actions\SendInviteReminder;
use App\Mail\InviteReminder;
use App\Models\Event;
use App\Models\Invite;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendInviteReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $events = Event::where('start_time', '<', Carbon::now()->addDays(14))
            ->where('is_active', '=', true)
            ->where('is_reminder_sent', '=', false)
            ->get();

        $events->each(function(Event $event) {
            /** @var Collection<Invite> $invites */
            $invites = $event->invites()->getResults();
            $invites->filter(fn (Invite $invite) => $invite->has_responded == false)
                ->each(function (Invite $invite) {
                    try {
                        Mail::to($invite)->queue(new InviteReminder($invite));
                    } catch (\Exception $exception) {
                        Log::error($exception->getMessage() . "\n Failed for " . $invite->email);
                    }
                });

            $event->is_reminder_sent = true;
            $event->save();
        });
    }
}
