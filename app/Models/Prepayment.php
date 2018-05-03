<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prepayment extends Model
{
    /**
     * Reduce by one the amount of prepayments of a user by its id
     * @param int $id
     *
     * @return boolean
     */
    public static function getUsersHistory(int $id)
    {
        return Prepayment::where('user_id', $id)->get();
    }
}
