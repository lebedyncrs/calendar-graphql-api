<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['title', 'timezone', 'start_at', 'end_at', 'owner_id'];

    /**
     * Event owner
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * List of calendars event belongs to
     * @return BelongsToMany
     */
    public function calendars(): belongsToMany
    {
        return $this->belongsToMany(Calendar::class, 'calendars_events');
    }

    /**
     * @return BelongsToMany
     */
    public function guests(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'events_guests',
            'events_id',
            'users_id'
        );
    }

    /**
     * @return HasMany
     */
    public function eventsGuests(): HasMany
    {
        return $this->hasMany(EventGuest::class, 'events_id');
    }

    /**
     * Verify if given user id is owner of current model instance
     * @param int $userId
     * @return bool
     */
    public function isOwner(int $userId): bool
    {
        return $this->owner_id == $userId;
    }
}
