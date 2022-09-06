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
                    <div class="card-header">{{ __('All Category') }}
                        <span class="float-end">
                        <a href="{{route('category.create')}}">
                            <button class="btn btn-outline-secondary">Add Category</button>
                        </a>
                    </span>
                    </div>

                    <div class="card-body">


                            <table class="table table-dark table-hover">

                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categorys as $category)
                                        <p></p>
                                    <tr>
                                        <th scope="row">{{$category->id}}</th>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <a href="{{route('category.edit',$category->id)}}">
                                                <button class="btn btn-outline-primary">Edit</button></a>
                                        </td>
                                        <td>

                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$category->id}}">
                                                   Delete
                                                </button>






                                            <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{route('category.destroy',$category->id)}}"method="post">
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



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
