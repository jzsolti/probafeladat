<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('hu');

        for($i = 0; $i < 10; $i++){
            User::create(['name' => $faker->name,'email'=> $faker->companyEmail,'password' => Hash::make('asdf1234')]);
        }

       
    }
}
