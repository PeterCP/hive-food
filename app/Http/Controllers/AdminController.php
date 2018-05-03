<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Menu;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        return redirect('admin/menu');
    }

    public function dishes(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $data['dishes'] = Dish::all();
        return view('admin.dishes.dishes', $data);
    }

    public function menu(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $dishesIds = array_map(
            function ($value) {
                return (int)$value;
            }, Menu::getDishesIds()
        );

        $data['menu'] = Menu::getDishes();
        $data['available_dishes'] = Dish::getDishesWithoutIds($dishesIds);
        return view('admin.menu.menu', $data);
    }

    public function todayOrders(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $orders = $this->setUsernameOfOrders(Order::getTodayOrders());
        $message = "Aquí puedes administrar las ordenes del dia de hoy.";
        return $this->renderOrdersView($orders, $message);
    }

    public function thisMonthOrders(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $orders = $this->setUsernameOfOrders(Order::getThisMonthOrders());
        $message = "Aquí puedes administrar las ordenes de este mes.";
        return $this->renderOrdersView($orders, $message);
    }

    public function sixMonthOrders(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $orders = $this->setUsernameOfOrders(Order::getLastSixMonthsOrders());
        $message = "Aquí puedes administrar las ordenes de los ultimos seis meses.";
        return $this->renderOrdersView($orders, $message);
    }

    public function allOrders(Request $request)
    {
        $request->user()->authorizeRoles('admin');
        $orders = $this->setUsernameOfOrders(Order::all());
        $message = "Aquí puedes administrar todas las ordenes.";
        return $this->renderOrdersView($orders, $message);
    }

    public function prepayments(Request $request){
        $request->user()->authorizeRoles('admin');
        $data['clients'] = User::getClients();
        return view('admin.prepayments.prepayments', $data);
    }

    public function cash(Request $request){
        $request->user()->authorizeRoles('admin');
        $data['clients'] = User::getClients();
        return view('admin.cash.cash', $data);
    }

    public function loyalty(Request $request){
        $request->user()->authorizeRoles('admin');
        $data['clients'] = User::getClients();
        return view('admin.loyalty.loyalty', $data);
    }

    public function stats(Request $request){
        $request->user()->authorizeRoles('admin');
        return view('admin.stats.stats');
    }

    public function users(Request $request){
        $request->user()->authorizeRoles('admin');
        $data['users'] = User::getClients();
        return view('admin.users.users', $data);
    }


    /*----------------------------------------------------------------------------------------**
    **----------------------------------- AUXILIARY METHODS ----------------------------------**
    **----------------------------------------------------------------------------------------*/

    private function renderOrdersView($orders, $message)
    {
        $data['orders']  = $orders;
        $data['message'] = $message;
        $data['platillos'] = $this->getDishesOfOrders($orders);
        return view('admin.orders.orders', $data);
    }

    private function setUsernameOfOrders($orders)
    {
        foreach ($orders as $order) {
            $order->username = User::getName($order->user_id);
        }
        return $orders;
    }

    private function getDishesOfOrders($order)
    {
        $platillos = array();

        foreach ($order as $order) {
            $platillos["order_id_$order->id"] = OrderItem::getDishesInOrder($order->id);
        }

        return $platillos;
    }

}
