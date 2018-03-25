<?php

namespace App\Repositories\EventGuest;

use App\Models\EventGuest;
use App\Repositories\Repository;

class EventGuestRepository extends Repository
{
    public function model()
    {
        return EventGuest::class;
    }
}