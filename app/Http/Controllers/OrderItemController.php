<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
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
     * @param int $id the id of the Dish
     *
     * @return int
     */
    public function editOrderItem($id)
    {
        $data['orderItem'] = OrderItem::find($id);
        if( count($data['orderItem']) === 1 ){
            return view('admin.orders.edit_order_item', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Displays the form to update the state of an Order
     *
     * @param int    $id the id of the Order
     * @param string $state the new state of the Order
     *
     * @return int
     */
    public function changeOrderStatus($id, $state)
    {
        if ( in_array($state, ['pending', 'ready', 'delivered']) ) {
            $order = Order::find( (int) $id);
            $order->state = $state;
            $order->save();
        }
        return back();
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
            'name' => 'required|max:80',
            'description' => 'max:250',
            'price' => 'required|numeric|min:0|max:150',
            'imagen' => 'image|max:2024|mimes:jpeg,jpg,png'
        ]);

        $dish = new Dish;
        $dish->save();
        return back()->withInput()->with('success', 'Se ha subido tu nuevo platillo.');
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
            'name' => 'required|max:80',
            'description' => 'max:250',
            'price' => 'required|numeric|min:0|max:150',
            'imagen' => 'image|max:2024|mimes:jpeg,jpg,png'
        ]);

        $dish = Dish::find($id);
        $dish->name = $request->input('name');
        $dish->save();
        return back()->withInput()->with('success', 'Se ha guardado la información de tu platillo.');
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
        $item = OrderItem::find($id);
        $item->delete();
        return back();
    }
}
