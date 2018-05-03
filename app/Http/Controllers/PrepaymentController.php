<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prepayment;
use App\Models\Cash;
use App\User;

class PrepaymentController extends Controller
{
    public function prepaymentHistory(Request $request, int $id)
    {
        $request->user()->authorizeRoles('admin');
        $data['history'] = Prepayment::getUsersHistory($id);
        return view('admin.prepayments.history', $data);
    }

    public function addPrepayment(Request $request, int $id, int $number)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        $prepayment =  new Prepayment();

        if( count($user) === 1  && $number > 0){
            $prepayment->user_id = $user->id;
            $user->prepayments  = $user->prepayments + $number;
            $prepayment->number = $number;
            $prepayment->save();
            $user->save();
        }

        return back();
    }

    public function reducePrepayment(Request $request, int $id)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        $prepayment =  new Prepayment();

        if( count($user) === 1 && $user->prepayments >= 1){
            $prepayment->user_id = $user->id;
            $user->prepayments  = $user->prepayments - 1;
            $prepayment->number = -1;
            $prepayment->save();
            $user->save();
        }

        return back();
    }



    public function cashHistory(Request $request, int $id)
    {
        $request->user()->authorizeRoles('admin');
        $data['history'] = Cash::getUsersHistory($id);
        return view('admin.cash.history', $data);
    }

    public function addCash(Request $request, int $id, float $number)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        $cash =  new Cash();

        if( count($user) === 1 && $number > 0){
            $cash->user_id = $user->id;
            $user->cash  = $user->cash + $number;
            $cash->number = $number;
            $cash->save();
            $user->save();
        }

        return back();
    }

    public function reduceCash(Request $request, int $id, float $number)
    {
        $request->user()->authorizeRoles('admin');
        $user = User::find($id);
        $cash =  new Cash();

        if( count($user) === 1 && ($user->cash - $number >= 0) ){
            $cash->user_id = $user->id;
            $user->cash  = $user->cash - $number;
            $cash->number = $number * -1;
            $cash->save();
            $user->save();
        }

        return back();
    }

}
