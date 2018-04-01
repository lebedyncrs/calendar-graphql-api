<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarShare extends Model
{
    /**
     * @var string
     */
    protected $table = 'calendars_shares';

    /**
     * @var array
     */
    protected $fillable = ['calendars_id', 'users_id', 'access_levels_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * @return BelongsTo
     */
    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class, 'calendars_id');
    }
}
