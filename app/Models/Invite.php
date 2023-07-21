<?php

namespace App\Models;

use App\Actions\SendInvite;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;

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
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
