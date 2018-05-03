<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prepayment;
use App\Models\Cash;
use App\User;

class LoyaltyController extends Controller
{
    public function addLoyaltyPoints(Request $request, int $id, int $number)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);

        if($user && $number > 0) {
            $user->loyalty_points += $number;
            $user->save();
            return back();
        } else {
            abort(400, "La cantidad de puntos debe ser positiva.");
        }
    }

    public function redeemLoyaltyPoints(Request $request, int $id)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        
        if($user && $user->loyalty_points >= 7) {
            $user->loyalty_points -= 7;
            $user->save();
            return back();
        } else {
            abort(400, "El cliente no tiene suficientes puntos.");
        }
    }
}
