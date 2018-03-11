<?php

use Illuminate\Database\Seeder;
use \App\Models\AccessLevel;

class AccessLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessLevels = [
            ['name' => 'Read', 'key' => 'read'],
            ['name' => 'Write', 'key' => 'write'],
        ];

        foreach ($accessLevels as $accessLevel) {
            $model = new AccessLevel($accessLevel);
            $model->save();
        }
    }
}
