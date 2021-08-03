<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Label;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('hu');
        for ($i = 0; $i < 12; $i++) {
            Label::create(['name' => $faker->word()]);
        }
        
    }
}
