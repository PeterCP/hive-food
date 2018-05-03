<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Dish;

class Menu extends Model
{

    protected $table = 'menu';

    /**
     * Get all the Dishes id's that are currently in the menu
     *
     * @return Dish[]
     */
    public static function getDishesIds()
    {
        return Menu::all('dish_id')->pluck('dish_id')->toArray();
    }

    /**
     * Saves dishes to the menu by passing it an array if Dishes ids
     *
     * @param array $ids the ids of the Dishes
     *
     * @return int
     */
    public static function addDishesToMenu(array $ids)
    {

        array_map(
            function($dish){
                return $dish;
            }, $ids
        );

        return Menu::all('dish_id')->pluck('dish_id')->toArray();
    }

    /**
     * Get all the Dishes that match the id's
     * @param array id's the ids
     *
     * @return Dish[]
     */
    public static function getDishes()
    {
        $dishesIds = Menu::getDishesIds();
        return Dish::findMany( $dishesIds );
    }
}
