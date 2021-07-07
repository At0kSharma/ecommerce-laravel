@extends('shop.layout')

@section('product_area')

<div class="container">
    <div class="row">
        <div class="col-sm d-flex flex-wrap justify-content-center">
            @foreach ($products as $product)
            <div class="card m-2 p-0 justify-content-between border-0 product-card text-center position-relative">
                <p class="position-absolute  p-0 text-danger border border-danger">{{$product->discount}}% OFF</p>
                {{-- <p class="position-absolute p-1 text-primary" style="right:0;"><i class="fas fa-cart-plus fa-2x"></i></p> --}}
                <a href="{{route('product',['id' => $product->id,'type' => $product->type,'body' => $product->body])}}"><img class="card-img-top " src="data:image/jpeg;base64,{{base64_encode($product->preview)}}" alt="Card image cap"></a>
                <div class="card-body d-flex flex-column p-0 m-0">
                    <div class="mt-auto">
                        <h5 class="card-title pt-0">{{$product->name}}</h5>
                        <span class="text-danger "><strike>${{$product->price}}</strike></span>
                        <span class="text-success pb-1 h5">A${{$product->price-($product->discount/100*$product->price)}}</span>
                        <div class="card-footer border-0 m-0 p-0 bg-white">
                            @php
                            if($product->ratings->count()!=0){
                                $star=($product->ratings->sum('rating'))/($product->ratings->count());
                            }
                            else {
                                $star=0;
                            }
                            @endphp
                            @if ($star != 0)
                                <div class="rating color-second">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i<=$star)
                                            <span><i class="fas fa-star fa-lg"></i></span>
                                        @else
                                            <span><i class="far fa-star fa-lg"></i></span>
                                        @endif
                                    @endfor
                                </div>              
                            @else
                                <div class="rating color-second">
                                    <span><i class="far fa-star fa-lg"></i></span>
                                    <span><i class="far fa-star fa-lg"></i></span>
                                    <span><i class="far fa-star fa-lg"></i></span>
                                    <span><i class="far fa-star fa-lg"></i></span>
                                    <span><i class="far fa-star fa-lg"></i></span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach  
            
        </div>
    </div>
  
</div>

    
@endsection