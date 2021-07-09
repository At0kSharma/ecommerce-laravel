@extends('admin.app')

@section('content')
    
@if ($products->count())
    <div class="container-fluid w-100">
        <div class="row">
        <h2 class="p-2 ">All Products</h2>
        </div>
        <div class="row">
            <table class="table datatable " >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th> 
                        <th>Clothing</th> 
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Date</th>
                        <th></th>
                    </tr>                
                </thead>
                <tbody>
                    @foreach ($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->body}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->discount}}</td>
                                <td>{{$item->created_at->diffForHumans() }}</td>
                                <td>
                                <div class="d-flex">
                                    <form action="{{ route('edit.product', $item->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn p-1 m-1 btn-outline-primary"><i class="fas fa-pen"></i></button>
                                    </form>                                  
                                </div>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    no products
@endif



@endsection