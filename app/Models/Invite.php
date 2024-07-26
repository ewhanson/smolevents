<?php

namespace App\Models;

use App\Actions\SendInvite;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Model\PushMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Laravel\Facades\LINEMessagingApi;
use Symfony\Component\Uid\Ulid;
use function Illuminate\Events\queueable;

/**
 * @property Ulid $id
 * @property string $name
 * @property string $email
 * @property boolean $is_attending
 * @property boolean $has_responded
 * @property int $number_attending
 * @property string $comments
 * @property boolean $is_invite_sent
 */
class Invite extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'email',
        'event_id',
        'is_attending',
        'has_responded',
        'number_attending',
        'comments',
        'is_invite_sent',
    ];

    protected static function booted()
    {
        static::created(function (Invite $invite) {
            if ($invite->event()->first()->is_active) {
                (new SendInvite($invite))->execute();
            }
        });

        static::saved(queueable(function (Invite $invite) {
            $original = $invite->getOriginal();
            if ($invite->name !== $original['name'] || $invite->email !== $original['email']) {
                return;
            }

            try {
                $event = $invite->event()->first();
                $text = '🎟️ Update for "' . $event->name . '":'. PHP_EOL . PHP_EOL . ($invite->is_attending ? '✅ ' : '❌ ') . $invite->name . ($invite->is_attending ? ' can attend!' : ' cannot attend.') . PHP_EOL . PHP_EOL . 'See: ' . url('admin/events/' . $invite->event_id);
                $message = new TextMessage(['type' => 'text', 'text' => $text]);
                $request =  new PushMessageRequest(['to' => config('line-bot.user_id'), 'messages' => [$message]]);
                LINEMessagingApi::pushMessage($request);
            } catch (\Exception $e) {
                Log::error("Couldn't send LINE message: " . $e->getMessage());
            }
        }));
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
