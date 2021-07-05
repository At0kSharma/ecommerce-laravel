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
                                   
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-product">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete-product" tabindex="-1" role="dialog" aria-labelledby="delete-productTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span>Are you sure </span><br>
                                                    <span>{{$item->id}}</span>
                                                    <span>Changes can't be revert</span>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{ route('delete.product', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" name="delete-image-submit" class="btn p-1 m-1 btn-outline-danger" value="Delete">
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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