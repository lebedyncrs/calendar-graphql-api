<?php

namespace tests\Unit\Models;

use App\Models\Event;
use App\Models\User;
use Tests\GraphQLTestCase;

class EventTest extends GraphQLTestCase
{
    public function testGetStartAtAttribute()
    {
        $user = factory(User::class)->create([
            'timezone' => 'Africa/Tripoli',
        ]);
        $this->actingAs($user);
        $event = factory(Event::class)->create([
            'timezone' => null,
            'start_at' => '2018-04-09 09:40:40',
            'end_at' => '2018-04-09 12:40:40',
            'is_all_day' => false,
            'owner_id' => $user
        ]);

        // should convert timestamp to user timezone
        $this->assertEquals('2018-04-09 11:40:40', $event->start_at);

        $event = factory(Event::class)->create([
            'timezone' => '	America/Anguilla',
            'start_at' => '2018-04-09 09:40:40',
            'end_at' => '2018-04-09 12:40:40',
            'is_all_day' => false,
            'owner_id' => $user
        ]);

        // should convert timestamp to event timezone
        $this->assertEquals('2018-04-09 05:40:40', $event->start_at);

        $event = factory(Event::class)->create([
            'timezone' => '	America/Anguilla',
            'start_at' => '2018-04-09 09:40:40',
            'end_at' => '2018-04-09 12:40:40',
            'is_all_day' => true,
            'owner_id' => $user
        ]);

        // shouldn't convert timestamp to event timezone
        $this->assertEquals('2018-04-09 09:40:40', $event->start_at);
    }

    public function testGetEndAtAttribute()
    {
        $user = factory(User::class)->create([
            'timezone' => 'Africa/Tripoli',
        ]);
        $this->actingAs($user);
        $event = factory(Event::class)->create([
            'timezone' => null,
            'start_at' => '2018-04-09 09:40:40',
            'end_at' => '2018-04-09 12:40:40',
            'is_all_day' => false,
            'owner_id' => $user
        ]);

        // should convert timestamp to user timezone
        $this->assertEquals('2018-04-09 14:40:40', $event->end_at);

        $event = factory(Event::class)->create([
            'timezone' => '	America/Anguilla',
            'start_at' => '2018-04-09 09:40:40',
            'end_at' => '2018-04-09 12:40:40',
            'is_all_day' => false,
            'owner_id' => $user
        ]);

        // should convert timestamp to event timezone
        $this->assertEquals('2018-04-09 08:40:40', $event->end_at);

        $event = factory(Event::class)->create([
            'timezone' => '	America/Anguilla',
            'start_at' => '2018-04-09 09:40:40',
            'end_at' => '2018-04-09 12:40:40',
            'is_all_day' => true,
            'owner_id' => $user
        ]);

        // shouldn't convert timestamp to event timezone
        $this->assertEquals('2018-04-09 12:40:40', $event->end_at);
    }
}