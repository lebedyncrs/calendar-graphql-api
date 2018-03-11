<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Calendar;

class CalendarsTablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Illuminate\Support\Collection $users */
        $users = \App\Models\User::get();
        $users->each(function (User $user) {
            factory(Calendar::class)->create([
                'name' => $user->getFullName(),
                'owner_id' => $user->id
            ]);
        });
    }
}
