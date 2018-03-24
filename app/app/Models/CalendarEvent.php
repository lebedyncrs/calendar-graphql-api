<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    /**
     * Disable created_at and updated_at columns auto handling
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'calendars_events';
}
