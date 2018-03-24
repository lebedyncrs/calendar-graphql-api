<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventGuest extends Model
{
    /**
     * @var string
     */
    protected $table = 'events_guests';

    /**
     * @return BelongsTo
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * @return BelongsTo
     */
    public function accessLevel(): BelongsTo
    {
        return $this->belongsTo(AccessLevel::class, 'access_levels_id');
    }

    /**
     * @return BelongsTo
     */
    public function invitationStatus(): BelongsTo
    {
        return $this->belongsTo(InvitationStatus::class, 'invitation_statuses_id');
    }
}
