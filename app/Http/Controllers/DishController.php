<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Dish;
use Illuminate\Support\Facades\Input;

class DishController extends Controller
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
     * Displays the form to update a Dish
     *
     * @param int $id the id of the Dish
     *
     * @return int
     */
    public function editDish($id)
    {
        $data['dish'] = Dish::find($id);
        return view('admin.dishes.edit_dish', $data);
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
        $dish->name = $request->input('name');
        $dish->description = $request->input('description');
        $dish->price = $request->input('price');

        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, \PATHINFO_FILENAME);
            $imageExtension = $image->getClientOriginalExtension();
            $imageStoreName = str_replace(" ", "_", $imageName . '___' . time() . '.' . $imageExtension);
            $image->move('uploads/dishes', $imageStoreName);
            //save the image field
            $dish->image = $imageStoreName;
        }

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
        $dish->description = $request->input('description');
        $dish->price = $request->input('price');

        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, \PATHINFO_FILENAME);
            $imageExtension = $image->getClientOriginalExtension();
            $imageStoreName = str_replace(" ", "_", $imageName . '___' . time() . '.' . $imageExtension);
            $image->move('uploads/dishes', $imageStoreName);

            $dish->image = $imageStoreName;
        }

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
        $dish = Dish::find($id);

        if (file_exists('uploads/dishes/' . $dish->image) && $dish->image !== 'no_image.png') {
            unlink(public_path('uploads/dishes/' . $dish->image));
        }

        $dish->delete();
        return back();
    }
}