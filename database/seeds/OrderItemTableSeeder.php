<?php

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Una orden con dos quesadillas y un pollo
        $quesadilla = new OrderItem();
        $quesadilla->order_id       = 1;
        $quesadilla->dish_id        = 1;
        $quesadilla->dish_name      = "Quesadilla";
        $quesadilla->dish_price     = 20;
        $quesadilla->dish_quantity  = 2;
        $quesadilla->subtotal       = $quesadilla->dish_price * $quesadilla->dish_quantity;
        $quesadilla->total          = $quesadilla->dish_price * $quesadilla->dish_quantity;
        $quesadilla->save();

        $pollo = new OrderItem();
        $pollo->order_id        = 1;
        $pollo->dish_id         = 2;
        $pollo->dish_name       = "Pollo";
        $pollo->dish_price      = 25;
        $pollo->dish_quantity   = 1;
        $pollo->subtotal        = $pollo->dish_price * $pollo->dish_quantity;
        $pollo->total           = $pollo->dish_price * $pollo->dish_quantity;
        $pollo->save();


        //Una orden con tres ensaladas
        $ensalada = new OrderItem();
        $ensalada->order_id       = 2;
        $ensalada->dish_id        = 3;
        $ensalada->dish_name      = 'Ensalada';
        $ensalada->dish_price     = 30;
        $ensalada->dish_quantity  = 3;
        $ensalada->subtotal       = $ensalada->dish_price * $ensalada->dish_quantity;
        $ensalada->total          = $ensalada->dish_price * $ensalada->dish_quantity;
        $ensalada->save();

    }
}
