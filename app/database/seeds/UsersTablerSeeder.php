<?php

use Illuminate\Database\Seeder;

class UsersTablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create([
            'name' => 'John',
            'surname' => 'Smith',
            'email' => 'john.smith@gmail.com',
            'timezone' => 'Asia/Pyongyang',
        ]);
        factory(\App\Models\User::class, 50)->create();
    }
}
