<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
    ];

    /**
     * Get all the Dishes that match the id's
     * @param array id's the ids
     *
     * @return Dish[]
     */
    public static function getDishesByIds(array $ids)
    {
        return Dish::findMany( $ids );
    }

    /**
     * Get all the Dishes that don`t match the id's
     * @param int[] id's the ids
     *
     * @return Dish[]
     */
    public static function getDishesWithoutIds(array $ids)
    {
        return Dish::whereNotIn('id', $ids)->get();
    }

}
