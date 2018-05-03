<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * Get all the dishes names form an order id
     * @param int $id The order id
     *
     * @return Dish[]
     */
    public static function getDishesInOrder(int $id)
    {
        return OrderItem::where('order_id', $id)->get();
    }

    /**
     * remove all the items that belong to an order
     * @param int $id The order id
     *
     * @return Dish[]
     */
    public static function deleteAllItemsOfOrder(int $id)
    {
        return OrderItem::where('order_id', $id)->delete();
    }

}
