<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CheckSheet, App\Models\Vehicle;

class CkeckSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('hu');
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            $vehicle->checkSeets()->create([
                'vehicle_name' => $vehicle->name,
                'job' => $faker->jobTitle,
                'comment' => $faker->text(200)
            ]);
        }
    }
}
