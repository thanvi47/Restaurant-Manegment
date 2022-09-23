<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        $foodcategorys = FoodCategory::all();

        $categorys = Category::all();
//        $foods=Food::paginate(1);
        return view('food.index', compact('foods', 'categorys', 'foodcategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();

        $foods = Food::orderBy('id', 'DESC')->first();
        return view('food.create', compact('foods', 'categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|',
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);

        $categorys = $request->all();
        $new_categorys = $categorys['category'];


        foreach ($new_categorys as $new_category) {

            FoodCategory::create([
                'category_id' => $new_category,
                'food_id' => $request->get('food_id'),
            ]);

        }

        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        Food::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
//        'category_id'=> $categorys ,

            'image' => $name

        ]);


        return redirect()->back()->with('message', 'Food Created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);
        return view('food.view', compact('food'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foodcategorys = FoodCategory::all();
        $food = Food::find($id);
        $categorys = Category::all();
        return view('food.edit', compact('food', 'categorys', 'foodcategorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|',
            'image' => 'mimes:png,jpg,jpeg',
        ]);
        $categorys = $request->all();

        $new_categorys = $categorys['category'];


        $foodcategory_ids = FoodCategory::all()->where('food_id', $id);

        foreach ($foodcategory_ids as $foodcategory_id) {

            $fcid = $foodcategory_id->id;


            foreach ($new_categorys as $new_category) {
                $foodcategory = FoodCategory::findOrFail($fcid);

                $foodcategory->category_id = $new_category;

                $foodcategory->save();
            }

        }


        $food = Food::find($id);
        $name = $food->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        $food->name = $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
//        $food->category_id=$categorys;
        $food->image = $name;
        $food->save();
        return redirect()->route('food.index')->with('message', 'Updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('food.index')->with('message', 'Deleted successfully');;
    }

    public function listFood()
    {
        $categorys = Category::all();
        $foods = Food::all();

        return view('welcome', compact('foods', 'categorys'));

    }

    public function contact()
    {

        $data = array(
            'name' => Food::get('name')
        );
//        $foods = Food::all();


        Mail::send('home', $data, function ($message) {
            $message->to('thanvisub47@gmail.com', 'Nikki')->subject('Login Details');
        });
    }
}
