@extends('layouts.app')

@section('content')

<!--   product  -->

<div class="container">
    
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif
        @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row ">
            @if (Cart::count()>0)
                <div class="col-sm-7 bg-white shadow rounded m-2 p-2">
                    <h5 class="p-2 m-2">{{Cart::count()}} Items in Shopping cart</h5>
                    <hr>
                    @foreach (Cart::content() as $item)
                        @foreach ($products as $product)
                            @if ($product->id == $item->id)
                                <div class="d-flex justify-content-between">
                                    <a href="{{route('product',['id' => $product->id,'type' => $product->type,'body' => $product->body])}}"><img style="width: 5em" src="data:image/jpeg;base64,{{base64_encode($product->thumbnail)}}" alt="PRODUCT IMG "></a>
                                    <div class="d-flex align-items-center">
                                        <div class="d-inline">
                                            <h6>{{$item->name}}</h6>
                                            <h6>size {{$item->options->size}}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="d-inline">
                                            <form action="{{route('cart.destroy', $item->rowId )}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light p-1 m-1">remove</button>
                                            </form>
                        
                                            {{-- <form action="{{route('cart.saveforlater', $item->rowId )}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-light p-1 m-1">save for later</button>
                                            </form> --}}
                                        </div>
                                    </div> 
                                    <div class="d-flex align-items-center">
                                        <h6 class="p-1 m-1">{{$item->qty}}</h6>
                                        {{-- <form action="{{route('cart.update', $item->rowId )}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-info p-1 m-1">+1</button>
                                        </form> --}}
                                    </div> 
                                    <div class="d-flex align-items-center">
                                        <h6>A$ {{$item->price+$item->price*0.1}}</h6>
                                    </div> 
                                </div>
                                <hr>  
                            @endif
                        @endforeach       
                    @endforeach 
                </div>
                <div class="col-sm-4 bg-white text-center shadow rounded m-2 p-2">
                    <h5 class="p-2 m-2">Summary</h5>
                    <hr>
                    <div class=" m-2 d-flex justify-content-between">
                        <div class="d-flex flex-column text-left">
                            <span>Subtotal</span>
                            <span>GST(10%)</span>
                        </div>
                        <div class="d-flex flex-column text-right">
                            <span >A$ {{Cart::subtotal()}}</span>
                            <span >A$ {{Cart::tax()}}</span>
                        </div>       
                    </div>
                    <hr>
                    <div class=" m-2 d-flex justify-content-between">
                        <div class="d-flex flex-column text-left">
                            <span class="h4">Grand Total</span>
                        </div>
                        <div class="d-flex flex-column text-right">
                            <span class="h4">A$ {{Cart::total()}}</span>
                        </div>       
                    </div>
                    <hr>                    
                    <a href="{{route('checkout.index')}}" class="btn m-2  btn-primary">Proceed to Checkout <i class="pl-4 fas fa-chevron-right"></i></a>
                </div>
            @else 
                <div class="alert alert-success">
                    <span>No item in cart!</span>
                </div>
            @endif  
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="d-flex justify-content-center p-2 m-2">
                    <a href="#" class="btn btn-outline-primary"><i class="pr-4 fas fa-chevron-left"></i>Continue Shopping</a>
                </div>
            </div>
        </div>
   
</div>
</section>

<!--   !product  -->

@endsection

         