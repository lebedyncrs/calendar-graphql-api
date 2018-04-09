<?php

namespace App\Models;

use Carbon\Carbon;
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
     * @return HasMany
     */
    public function guests(): HasMany
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

    /**
     * Convert attribute to string data instead of Carbon object
     * @return string
     */
    public function getCreatedAtAttribute(): string
    {
        return $this->convertTimestampToProperTimezone($this->attributes['created_at']);
    }

    /**
     * Convert attribute to string data instead of Carbon object
     * @return string
     */
    public function getUpdatedAtAttribute(): string
    {
        return $this->convertTimestampToProperTimezone($this->attributes['updated_at']);
    }

    /**
     * @return null|string
     */
    public function getStartAtAttribute(): ?string
    {
        return $this->convertTimestampToProperTimezone($this->attributes['start_at']);
    }

    /**
     * @return null|string
     */
    public function getEndAtAttribute(): ?string
    {
        return $this->convertTimestampToProperTimezone($this->attributes['end_at']);
    }

    /**
     * @param null|string $timestamp
     * @return null|string
     */
    protected function convertTimestampToProperTimezone(?string $timestamp):?string
    {
        if (empty($timestamp)) {
            return null;
        }

        // all day events are not timezone aware they span whole day regardless of user's timezone
        if (isset($this->attributes['is_all_day']) && $this->attributes['is_all_day']) {
            return $timestamp;
        }

        $timezone = $this->attributes['timezone'];
        if (empty($timezone)) {
            $timezone = auth()->user()->timezone;
        }

        return Carbon::createFromTimeString($timestamp)
            ->timezone($timezone)
            ->format(config('app.date_format'));
    }
}
