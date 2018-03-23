<?php

use Illuminate\Database\Seeder;
use \App\Models\Calendar;
use \App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Illuminate\Support\Collection $calendars */
        $calendars = Calendar::get();
        $calendars->each(function (Calendar $calendar) {
            $event = factory(Event::class)->create([
                'owner_id' => $calendar->owner_id
            ]);
            $calendarEvent = new \App\Models\CalendarEvent();
            $calendarEvent->calendars_id = $calendar->id;
            $calendarEvent->events_id = $event->id;
            $calendarEvent->save();

            $eventGuest = new \App\Models\EventGuest();
            $eventGuest->events_id = $event->id;
            $eventGuest->users_id = $calendar->owner_id;
            $eventGuest->access_levels_id = 1;
            $eventGuest->invitation_statuses_id = 1;
            $eventGuest->is_organizer = true;
            $eventGuest->save();
        });
    }
}
