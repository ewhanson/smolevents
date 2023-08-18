<?php

namespace App\Jobs;

use App\Mail\EventNotice;
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

class SendEventNotice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $events = Event::where('start_time', '<', Carbon::now()->addDays(1))
            ->where('is_active', '=', true)
            ->where('is_event_notice_sent', '=', false)
            ->get();

        $events->each(function(Event $event) {
            /** @var Collection<Invite> $invites */
            $invites = $event->invites()->getResults();
            $invites->filter(fn (Invite $invite) => $invite->is_attending == true)
                ->each(function (Invite $invite) {
                    try {
                        Mail::to($invite)->queue(new EventNotice($invite));
                    } catch (\Exception $exception) {
                        Log::error($exception->getMessage() . "\n Failed for " . $invite->email);
                    }
                });

            $event->is_event_notice_sent = true;
            $event->save();
        });

    }
}
