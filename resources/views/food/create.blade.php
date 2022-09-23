@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>  {{Session::Get('message')}}!</strong> You should check in on some of those fields below.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
{{--                    <div class="alert alert-success">--}}
{{--                        {{Session::Get('message')}}--}}
{{--                    </div>--}}
                @endif
                <form action="{{route('food.store')}}"enctype="multipart/form-data" method="post">@csrf
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                       <div class="form-group">
                           <lable for="name"><b>Name</b></lable>
                           <input type="text" name="name" class="form-control @error('name')is-invalid @enderror"  >
                           <input type="hidden" name="food_id" value="@if(!isset($foods->id)){{ 1 }} @else {{$foods->id+1}} @endif"  >


                       </div>


                        <div class="form-group">
                           <lable for="name"><b>Description</b></lable>
                           <input type="text" name="description" class="form-control @error('description')is-invalid @enderror" >


                       </div>

                        <div class="form-group">
                           <lable for="price"><b>Price</b></lable>
                           <input type="text" name="price" class="form-control @error('price')is-invalid @enderror" >


                       </div>


                        <div class="form-group">
                           <lable for="category"><b>Category</b></lable>
                            <br>

                                @foreach($categorys as $category)
{{--                                    <option value="{{$category->id}}">{{$category->name}}</option>--}}
                                <input type="checkbox" name="category[]" value="{{$category->id}}" class="m-1 @error('name')is-invalid @enderror" >{{$category->name}}

                                @endforeach


                       </div>
                        <div class="form-group">
                            <lable for="name"><b>Image</b></lable>
                            <input type="file" name="image" class="form-control @error('image')is-invalid @enderror" >
                        </div>
                            <br>
                        <div class="form-group">
                            <button class="btn btn-outline-info"><b>Submit</b></button>
                        </div>
                    </div>

                </div>
                </form>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <p><strong>Opps Something went wrong</strong></p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
            </div>

        </div>
    </div>
@endsection
