@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm border bg-white">
            @if ($message = Session::get('success'))
                <div class="p-2 m-2 alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif
            @if ($addresses->count()>0)
            <div class="p-2 m-2 border shadow bg-secondary text-white">
                <span class="h5">ADDRESS</span>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($addresses as $address)
                <div class="p-2 m-2 border shadow bg-white d-flex flex-column" style="width: 22em">
                    <span>{{$address->name}}</span>
                    <span>{{$address->email}}</span>
                    <span>{{$address->phone}}</span>
                    <span>{{$address->street}}</span>
                    <span>{{$address->city}}</span>
                    <span>{{$address->state}}</span>
                    <span>{{$address->zipcode}}</span>
                    <span>{{$address->country}}</span>
                </div>
                @endforeach
            </div>
            @endif
           
        </div>
    </div>
    <div class="row ">
        <div class="col-sm border bg-white">
            <div class="p-2 m-2 border shadow bg-secondary text-white">
                <span class="h5">ORDERS</span>
            </div>
          @if ($orders->count() > 0)
            @foreach ($orders as $order)
                @php 
                $order_details = (json_decode($order->order,true));
                $n=1;
                @endphp
                    <div class="p-2 m-2 border shadow bg-white">
                        <div class="p-2 m-2">
                            <span>order Id : {{$order->id}}</span>
                            <span class=" text-white p-1 m-1
                                    @if($order->status == 0)
                                    bg-danger
                                    text-white
                                    @endif
                                    @if($order->status == 1)
                                    bg-warning
                                    text-dark
                                    @endif
                                    @if($order->status == 2)
                                    bg-primary
                                    text-white
                                    @endif
                                ">status : 
                                @if($order->status == 0)
                                Pending
                                @endif
                                @if($order->status == 1)
                                Shipping
                                @endif
                                @if($order->status == 2)
                                Complete
                                @endif
                            </span>
                        </div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $details)
                                <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{$details['name']}}</td>
                                    <td>{{$details['size']}}</td>
                                    <td>{{$details['qty']}}</td>
                                    <td>{{$details['price']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            @endforeach
          @else
            <span>You haven't bought anything</span>    
          @endif
        </div> 
    </div>
</div>
    
@endsection