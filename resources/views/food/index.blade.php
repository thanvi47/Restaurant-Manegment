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
                <div class="card">
                    <div class="card-header">{{ __('All Food') }}
                    <span class="float-end">
                        <a href="{{route('food.create')}}">
                            <button class="btn btn-outline-secondary">Add Food</button>
                        </a>
                    </span>
                    </div>

                    <div class="card-body">


                            <table class="table table-dark table-hover">

                                    <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($foods as $food)
                                        <p></p>
                                    <tr>
                                        <td><img src="{{asset('images')}}/{{$food->image}}" width="100" alt="">
                                            </td>


                                        <td>{{$food->name}}</td>
                                        <td>{{$food->description}}</td>
                                        <td>{{$food->price}}</td>
                                        <td>
                                            @foreach($categorys as $category)

                                            @foreach($foodcategorys as $foodcategory)

                                            @if($category->id==$foodcategory->category_id && $food->id == $foodcategory->food_id )
                                                {{$category->name }}<br>


                                                @endif

                                            @endforeach
                                            @endforeach
                                        </td>
                                        <td >

                                            <a href="{{route('food.edit',$food->id,)}}">
                                                <button class="btn btn-outline-primary ">Edit</button></a>
                                        </td>
                                        <td>

                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$food->id}}">
                                                   Delete
                                                </button>






                                            <div class="modal fade" id="exampleModal{{$food->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{route('food.destroy',$food->id)}}"method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                       <div class="alert alert-warning"> <strong> ⚠ Are you sure?</strong>  </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                        @endforeach
                                    </tr>

                                    </tbody>
                                </table>
{{--                      <div style="width:20px; height: 10px; ">{{ $foods->links() }}</div>--}}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
