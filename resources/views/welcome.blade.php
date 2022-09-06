
@extends('layouts.app');
        @section('content')


            <div class="container">
                <div class="row justify-content-center">
                    @foreach($categorys as $category)
                    <div class="col-md-12 ">
                        <h2>{{$category->name}}</h2>
                                <div class="jumbotron ">
                                    <div class="row  ">
                                      @foreach(\App\Models\Food::where('category_id',$category->id)->get() as $food)
                                        <div class="col-md-4 ">
                                            <br>  <img src="{{asset('images')}}/{{$food->image}}" height="100" width="150" alt="">
                                        <p class="text-sm-start">{{$food->name}}</p>
                                        <p class="text-sm-startr">{{$food->price}}</p>


                                        <a class="btn btn-outline-primary btn-lg" href="#" role="button">Learn more</a>
                                        </div>
                                        @endforeach

                                    </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>






        @endsection
