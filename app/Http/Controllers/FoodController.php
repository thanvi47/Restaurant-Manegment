<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods=Food::all();
//        $foods=Food::paginate(1);
        return view('food.index',compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categorys=Category::all();
        $foods=Food::all();
        return view('food.create',compact('foods','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $this->validate($request, [
           'name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'category'=>'required|',
            'image'=>'required|mimes:png,jpg,jpeg',
        ]);
    $image =$request->file('image');
    $name=time().'.'.$image->getClientOriginalExtension();
    $destinationPath=public_path('/images');
    $image->move($destinationPath,$name);
    Food::create([
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
        'price'=>$request->get('price'),
        'category_id'=>$request->get('category'),
        'image'=>$name

    ]);

return redirect()->back()->with('message','Food Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $food=Food::find($id);
       $categorys=Category::all();
       return view('food.edit',compact('food','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',
            'category'=>'required|',
            'image'=>'mimes:png,jpg,jpeg',
        ]);
        $food=Food::find($id);
        $name =$food->image;
        if ($request->hasFile('image')){
            $image =$request->file('image');
            $name=time().'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/images');
            $image->move($destinationPath,$name);
        }
        $food->name=$request->get('name');
        $food-> description=$request->get('description');
        $food->price=$request->get('price');
        $food->category_id=$request->get('category');
        $food->image=$name;
        $food->save();
        return redirect()->route('food.index')->with('message','Updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food=Food::find($id);
        $food->delete();
        return redirect()->route('food.index')->with('message','Deleted successfully');;
    }
    public function listFood()
    {
        $categorys=Category::all();
        $foods=Food::all();

        return view('welcome',compact('foods','categorys'));

    }
}
