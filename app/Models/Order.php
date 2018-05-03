<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Order extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * Get all the orders that were created today
     *
     * @return Order[]
     */
    public static function getTodayOrdersByUserId($userId)
    {
        return Order::where('user_id', $userId)->whereDate('created_at', '=', date('Y-m-d'))->get();
    }

    /**
     * Get all the orders that were created today
     *
     * @return Order[]
     */
    public static function getTodayOrders()
    {
        return Order::whereDate('created_at', '=', date('Y-m-d'))->get();
    }

    /**
     * Get all the orders that were created in the last month
     *
     * @return Order[]
     */
    public static function getThisMonthOrders()
    {
        return Order::whereMonth('created_at', '=', date('m'))->get();
    }

    /**
     * Get all the orders that were created in the last month
     *
     * @return Order[]
     */
    public static function getLastSixMonthsOrders()
    {
        return Order::where("created_at", ">", Carbon::now()->subMonths(6))->get();
    }


}
