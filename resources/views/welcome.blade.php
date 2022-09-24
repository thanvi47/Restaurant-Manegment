
@extends('layouts.app')
        @section('content')


            <div class="container">
                <div class="row justify-content-center">
                    @foreach($categorys as $category)
                    <div class="col-md-12 ">
                        <h2 class="my-2">{{$category->name}}</h2>
                                <div class="jumbotron "color="rgba(255, 255, 0, 01.3)">
                                    <div class="row  ">
                                      @foreach(\App\Models\FoodCategory::where('category_id',$category->id)->get() as $food)
                                          @foreach(\App\Models\Food::where('id',$food->food_id)->get() as $food)
                                        <div class="col-md-4 ">
                                            <br>  <img src="{{asset('images')}}/{{$food->image}}" height="100" width="150" alt="">
                                      <strong> <p class="text-sm-start  my-1">{{$food->name}}</p></strong>
                                           <b></b> <p class="text-sm-startr">{{$food->price}} ৳</p>


                                        <a class="btn btn-outline-primary btn-lg" href="{{route('food.show',$food->id)}}" role="button">Learn more</a>
                                        </div>
                                        @endforeach
                                        @endforeach

                                    </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>






        @endsection
