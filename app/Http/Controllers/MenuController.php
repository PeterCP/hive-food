<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Menu;
use Psy\Util\Json;
use \App\Models\Dish;

class MenuController extends Controller
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
     * get Menu as Json
     *
     * @return Json
     */
    public function getMenu()
    {
        $dishesInMenu = Menu::all(['dish_id'])->pluck('dish_id')->toArray();
        //casting them to int
        $idsOfDishesInMenu = array_map( function($dish) { return (int) $dish ; }, $dishesInMenu );
        $menu = Dish::getDishesByIds($idsOfDishesInMenu);
        return response( $menu->toJson() )->header('Content-Type', 'application/json');
    }

    /**
     * Saves dishes to the menu by passing it an array if Dishes ids
     *
     * @param \Illuminate\Http\Request $request the store request
     *
     * @return int
     */
    public function addDishesToMenu(Request $request)
    {
        $this->validate($request, [
            'dishes' => 'required|array|min:1',
        ]);

        array_map(
            function($dish_id){
                $menuEntry = new Menu();
                $menuEntry->dish_id = $dish_id;
                $menuEntry->save();
                return $menuEntry;
            }, $request->input('dishes')
        );

        return back()->with('success', 'Se han agregado tus platillos al menu.');
    }

    /**
     * Remove a dish form the Menu by passing its id
     *
     * @param int $id the id of the dish to remove from the menu
     *
     * @return View
     */
    public function removeDishFromMenu(int $id = 0)
    {
        $dish = Menu::where('dish_id', $id)->get()->first();
        $dish->delete();
        return back()->with('success', 'Se han removido el platillo del menu.');
    }
}
