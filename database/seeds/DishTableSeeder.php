<?php

use Illuminate\Database\Seeder;
use \App\Models\Dish;
use Faker as Faker;

class DishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  Faker\Factory::create();

        $quesadilla = new Dish;
        $quesadilla->name = 'Quesadilla';
        $quesadilla->description = $faker->sentence();
        $quesadilla->price = $faker->randomFloat(2, 0, 80);
        $quesadilla->save();

        $pollo = new Dish;
        $pollo->name = 'Pollo';
        $pollo->description = $faker->sentence();
        $pollo->price = $faker->randomFloat(2, 0, 80);
        $pollo->save();

        $ensalada = new Dish;
        $ensalada->name = 'Ensalada';
        $ensalada->description = $faker->sentence();
        $ensalada->price = $faker->randomFloat(2, 0, 80);
        $ensalada->save();

    }
}
