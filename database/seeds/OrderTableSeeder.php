<?php

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Una orden del cliente 2
        $order = new Order();
        $order->user_id  = 2;
        $order->subtotal = 65;
        $order->total    = 65;
        $order->total    = 65;
        $order->save();

        //Una orden del cliente 3
        $order = new Order();
        $order->user_id  = 3;
        $order->subtotal = 90;
        $order->total    = 90;
        $order->total    = 90;
        $order->save();

    }
}
