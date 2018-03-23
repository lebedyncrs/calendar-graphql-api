<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'timezone', 'start_at', 'end_at', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function calendars()
    {
        return $this->belongsToMany(Calendar::class, 'calendars_events');
    }

    public function isOwner(int $userId): bool
    {
        return $this->owner_id == $userId;
    }
}
