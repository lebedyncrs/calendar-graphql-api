<?php

namespace App\Repositories;


use App\Models\Event;

class EventRepository extends Repository
{
    public function model()
    {
        return Event::class;
    }
}