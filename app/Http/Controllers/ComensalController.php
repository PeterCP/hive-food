<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComensalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['client']);
        $data['userId']             = $request->user()->id;
        $data['userName']           = $request->user()->name;
        $data['userPoints']         = $request->user()->loyalty_points;
        $data['getOrdersUrl']       = url("/orders/" . $request->user()->id);
        $data['getMenuUrl']         = url('/menu');
        $data['createNewOrdersUrl'] = url('/order');
        $data['plates']             = $request->user()->prepayments;
        $data['cash']               = $request->user()->cash;
        return view('client.order.order', $data);
    }

    public function thankyou(Request $request)
    {
        $request->user()->authorizeRoles(['client']);
        return view('client.order.thankyou', array());
    }

    public function error(Request $request)
    {
        $request->user()->authorizeRoles(['client']);
        return view('client.order.error', array());
    }

}
