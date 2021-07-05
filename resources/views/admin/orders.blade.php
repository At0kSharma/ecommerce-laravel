@extends('admin.app')

@section('content')
<div class="container">
    {{-- orders  --}}
    <div class="row ">
        <div class="col-sm border rounded bg-white">
            @if ($message = Session::get('success'))
            <div class="alert alert-success p-2 m-2 border rounded text-center">
                <p>{{$message}}</p>
            </div>
            @endif
            <div class="p-2 m-2 border rounded shadow bg-primary text-white">
                <span class="h5">{{strtoupper($status)}} ORDERS</span>
            </div>
          @if ($orders->count() > 0)
            @foreach ($orders as $order)
                @php 
                $order_details = (json_decode($order->order,true));
                $n=1;
                @endphp
                    <div class="p-2 m-2 border border-primary rounded shadow bg-white">
                        <div class="p-2 d-flex justify-content-between">
                            <span class="rounded text-white bg-primary p-2 ">Order Id : {{$order->id}}</span>
                            <form action="{{route('orders.store',$order->id)}}" method="post" class="d-flex">
                                <select name="status" id="status" class="border border-primary rounded mr-2">
                                    <option value="">Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Shipping</option>
                                    <option value="2">Complete</option>
                                    <option value="3">Return</option>
                                </select>
                                <button type="submit" class="btn btn-primary p-2">Update</button>
                                @csrf
                            </form>                            
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
                        <div class="p-2 m-2 d-flex border rounded bg-light">
                            <div class="d-flex flex-column p-2 m-2">
                                <h5>Personal Details</h5>
                                <span>{{$order->address->name}}</span>
                                <span>{{$order->address->email}}</span>
                                <span>{{$order->address->phone}}</span>
                            </div>
                            <div class="d-flex flex-column p-2 m-2">
                                <h5>Address Details</h5>
                                <span>{{$order->address->street}}</span>
                                <span>{{$order->address->city}}</span>
                                <span>{{$order->address->state}}</span>
                                <span>{{$order->address->zipcode}}</span>
                                <span>{{$order->address->country}}</span>
                            </div>
                        </div>
                    </div>
            @endforeach
          @else
            <span>{{strtoupper($status)}} Orders Status 0:</span>    
          @endif
        </div> 
    </div>
</div>
@endsection