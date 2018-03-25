<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventGuest extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['events_id', 'users_id', 'invitation_statuses_id', 'access_levels_id', 'is_organizer'];
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

    /**
     * Determine if giving user id is organizer of event
     * @param int $userId
     * @return bool
     */
    public function isOrganizer(int $userId): bool
    {
        return $userId == $this->users_id && $this->is_organizer;
    }
}
