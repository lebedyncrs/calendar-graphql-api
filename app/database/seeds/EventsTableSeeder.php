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
        $calendars->each(function (Calendar $user) {
            factory(Event::class)->create([
                'owner_id' => $user->id
            ]);
        });
    }
}
