<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Role;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the form to update an Order
     *
     * @param int $id the id of the User
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $data['user'] = User::find($id);
        if( count($data['user']) === 1 ){
            return view('admin.users.edit', $data);
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request the store request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:80',
            'email' => 'required|email',
            'phone' => 'required',
            //'room'  => 'numeric',
            'password'  => 'required|max:16'
        ]);

        $user = new User();
        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if ( $request->input('room') == null){
            $user->room  = 'no existe';
        } else {
            $user->room  = $request->input('room');
        }

        $user->password = bcrypt( $request->input('password') );
        $user->save();

        $role_comensal  = Role::where('name', 'client')->first();
        $user->roles()->attach($role_comensal);

        return back()->withInput()->with('success', 'Se ha creado tu nuevo cliente.');
    }

    /**
     * update a Dish resource in storage.
     *
     * @param \Illuminate\Http\Request $request the store request
     * @param int $id the id of the Dish resource
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name'  => 'required|max:80',
            'email' => 'required|email',
            'phone' => 'required',
            //'room'  => 'numeric',
            'password'  => 'max:16'
        ]);

        $user = User::find($id);
        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if ( $request->input('room') == null){
            $user->room  = 'no existe';
        } else {
            $user->room  = $request->input('room');
        }

        if($request->input('password') != ''){
            $user->password = bcrypt( $request->input('password') );
        }

        $user->save();

        $role_comensal  = Role::where('name', 'client')->first();
        $user->roles()->attach($role_comensal);

        return back()->withInput()->with('success', 'Se ha guardado la información de tu cliente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id the id of the proyecto
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }

}
