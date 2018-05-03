<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    public function testingElmPostJson()
    {
        $data = Input::all();
        $data['id']; // The ID of the request
    }

        /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->user() != null) {
            if ($request->user()->hasRole('admin')) {
                return redirect('/admin');
            } else if ($request->user()->hasRole('client')) {
                return redirect('/comensal');
            }
        } else {
            return redirect('/login');
            //uncoment method whe homepage is desired
            //return view('welcome');
        }


    }
}
