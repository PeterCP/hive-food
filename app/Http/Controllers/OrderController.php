<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Dish;
use Illuminate\Support\Facades\Input;


class OrderController extends Controller
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
    public function editOrder($id)
    {
        $data['order'] = Order::find($id);
        if (count($data['order']) === 1) {
            $data['dishes'] = OrderItem::getDishesInOrder($id);
            return view('admin.orders.edit_order', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Displays the form to update the state of an Order
     *
     * @param int $id the id of the Order
     * @param string $state the new state of the Order
     *
     * @return int
     */
    public function changeOrderStatus(int $id, $state)
    {
        if (in_array($state, ['pending', 'ready', 'delivered'])) {
            $order = Order::find((int)$id);
            $order->state = $state;
            $order->save();
        }
        return back();
    }

    /**
     * get Menu as Json
     *
     * @return Json
     */
    public function getOrdersByUser($userId)
    {
        $orders = Order::getTodayOrdersByUserId($userId);
        return response($orders->toJson())->header('Content-Type', 'application/json');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request the store request
     *
     * @return String
     */
    public function newOrder(Request $request)
    {

        $requestOrderItems = $request->input('orderItems');

        if (!is_array($requestOrderItems) || $requestOrderItems == null) {
            abort(404);
        }

        $orderItems = array_filter($requestOrderItems, function ($orderItem) {
            if (is_int($orderItem['dish_id']) && is_int($orderItem['quantity'])) {
                if ($orderItem['dish_id'] > 0 && $orderItem['quantity'] > 0) {
                    if (Dish::find($orderItem['dish_id'])) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        });

        $subtotal = array_reduce($orderItems, function ($acumulator, $item) {
            $dish = Dish::find($item['dish_id']);
            $acumulator += $item['quantity'] * $dish->price;
            return $acumulator;
        });

        $user = $request->user();

        //TODO: crear descuento si es residente
        $discount = 1;
        $total = $subtotal * $discount;

        $order = new Order();
        $order->user_id = $user->id;
        $order->subtotal = $subtotal;
        $order->total = $total;
        $order->save();

        $orderId = $order->id;

        foreach ($orderItems as $orderItem) {
            $dish = Dish::find($orderItem['dish_id']);
            $item = new OrderItem();
            $item->order_id = $orderId;
            $item->dish_id = $dish->id;
            $item->dish_name = $dish->name;
            $item->dish_price = $dish->price;
            $item->dish_quantity = $orderItem['quantity'];
            $item->subtotal = $dish->price * $orderItem['quantity'];
            $item->total = $item->subtotal * 1;
            $item->save();
        }

        // Incrementar los puntos de lealtad del usuario.
        $user->loyalty_points += 1;
        $user->save();

        return $order->toJson();
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
        $order = Order::find($id);
        OrderItem::deleteAllItemsOfOrder($id);
        $order->delete();
        return back();
    }
}
