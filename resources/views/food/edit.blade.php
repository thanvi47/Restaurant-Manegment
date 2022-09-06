@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::Get('message')}}
                    </div>
                @endif
                <form action="{{route('food.update',$food->id)}}" enctype="multipart/form-data" method="post">@csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">{{ __('Update') }}</div>

                    <div class="card-body">
                       <div class="form-group">
                           <lable for="name"><b>Name</b></lable>
                           <input type="text" name="name" value="{{$food->name}}" class="form-control @error('name')is-invalid @enderror" >

                       </div>
                        <div class="form-group">
                           <lable for="name"><b>Description</b></lable>
                           <input type="text" name="description" value="{{$food->description}}" class="form-control @error('description')is-invalid @enderror" >

                       </div> <div class="form-group">
                           <lable for="name"><b>Price</b></lable>
                           <input type="text" name="price" value="{{$food->price}}" class="form-control @error('price')is-invalid @enderror" >

                       </div>
                        <div class="form-group">
                           <lable for="name"><b>Category</b></lable>
                            <select name="category" class="form-control @error('category')is-invalid @enderror" >
                                <option value="">Select Category</option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}" @if($category->id==$food->category_id) selected @endif>{{$category->name}}</option>


                                @endforeach

                            </select>
{{--                           <input type="text" name="category" value="{{$food->category_id}}" class="form-control @error('category_id')is-invalid @enderror" >--}}

                       </div>
                        <div class="form-group">
                           <lable for="name"><b>Image</b></lable>
                           <input type="file" name="image" value="{{$food->image}}" class="form-control @error('image')is-invalid @enderror" >

                       </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-outline-info"><b>Update</b></button>
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
