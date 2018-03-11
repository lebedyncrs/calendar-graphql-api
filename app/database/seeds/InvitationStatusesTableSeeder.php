<?php

use Illuminate\Database\Seeder;
use \App\Models\InvitationStatus;

class InvitationStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessLevels = [
            ['name' => 'Yes', 'key' => 'yes'],
            ['name' => 'No', 'key' => 'no'],
            ['name' => 'Maybe', 'key' => 'maybe'],
            ['name' => 'Unknown', 'key' => 'unknown'],
        ];

        foreach ($accessLevels as $accessLevel) {
            $model = new InvitationStatus($accessLevel);
            $model->save();
        }
    }
}
