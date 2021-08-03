<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle, App\Models\User;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('hu');

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                Vehicle::create(['user_id' => $user->id, 'name' => $user->id.'-'.$i.'-'.$faker->word, 'owner_email' => $faker->email]);
            }
        }
    }
}
