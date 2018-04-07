<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Calendar extends Model
{

    /**
     * @param Builder $query
     * @param array $ids
     * @return void
     */
    public function scopeIdIn(Builder $query, array $ids): void
    {
        $query->whereIn('id', $ids);
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'calendars_events', 'calendars_id', 'events_id');
    }

    /**
     * Convert attribute to string data instead of Carbon object
     * @return string
     */
    public function getCreatedAtAttribute(): string
    {
        return Carbon::createFromTimeString($this->attributes['created_at'])
            ->timezone(auth()->user()->timezone)
            ->format(config('app.date_format'));
    }

    /**
     * Convert attribute to string data instead of Carbon object
     * @return string
     */
    public function getUpdatedAtAttribute(): string
    {
        return Carbon::createFromTimeString($this->attributes['created_at'])
            ->timezone(auth()->user()->timezone)
            ->format(config('app.date_format'));
    }
}
