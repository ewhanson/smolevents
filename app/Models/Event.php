<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Symfony\Component\Uid\Ulid;

/**
 * @property Ulid $id
 * @property string $name
 * @property string $description
 * @property string $host
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property string $location
 * @property boolean $is_active
 * @property boolean $is_reminder_sent
 * @property boolean $is_event_notice_sent
 */
class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'location',
        'host',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class);
    }
}
