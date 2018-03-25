<?php

namespace App\Repositories\CalendarShare;

use App\Models\CalendarShare;
use App\Repositories\Repository;

class CalendarShareRepository extends Repository
{
    public function model()
    {
        return CalendarShare::class;
    }

    /**
     * Return ids of shared calendars by passed user id
     */
    public function getIdsByUser(int $id)
    {
        $this->pushCriteria(new UsersIdEqualCriteria($id));
        return $this->all(['calendars_id'])->pluck('calendars_id')->all();
    }

}