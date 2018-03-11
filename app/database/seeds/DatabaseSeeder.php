<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccessLevelsTableSeeder::class);
        $this->call(InvitationStatusesTableSeeder::class);
        $this->call(UsersTablerSeeder::class);
        $this->call(CalendarsTablerSeeder::class);
        $this->call(EventsTableSeeder::class);
    }
}
