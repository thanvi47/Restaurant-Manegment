@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Product Details') }}</div>

                    <img  src="{{asset('images')}}/{{$food->image}}" alt="food image">
                    <div class="card-body">

                        <strong> <p class="text-sm-start">{{$food->name}}</p></strong>
                        <b></b> <p class="text-xl-start">{{$food->price}} ৳</p>
                        <b></b> <p class="text-sm-start">{{$food->description}} </p>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
