<!-- Top Sale -->
    <div class="container pt-5">
        <div class="d-flex justify-content-center">
            <h3 class="color-second font-weight-bold" style="border-bottom: 3px solid #1a2238">New Arival</h3>
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex flex-wrap justify-content-center ">
                @foreach ($products as $product)
                <div class="card m-2 p-0 justify-content-between border-0 text-center product-card">
                    <p class="position-absolute rounded p-0 text-danger border border-danger discount">{{$product->discount}}% OFF</p>                 
                    <img class="card-img-top" src="data:image/jpeg;base64,{{base64_encode($product->preview)}}" alt="Card image cap">
                    <div class="add-cart" style="font-size: 16px">
                        <span class="text-white bg-dark p-2"> @if ($product->quantity->count()){{$product->discount}}% OFF @else SOLD OUT  @endif</span>
                        <form action="{{ route('cart.store') }}" method="post" class="p-2">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="price" value="{{($product->price-($product->discount/100*$product->price))*100/110}}">
                            <input type="hidden" name="name" value="{{$product->name}}">
                            @if ($product->quantity->count())
                                <div class="d-flex pt-2">
                                    <select class="p-0 m-0" name="selected_size">
                                    @foreach ($product->quantity as $quantity)
                                    <option value="{{$quantity->size->size}}">{{$quantity->size->size}}</option>
                                    @endforeach
                                    </select>
                                    <button type="submit"  @if($product->quantity->count() == 0) disabled @endif class="btn color-second"><i class="fas fa-shopping-cart fa-2x"></i></button>
                                </div>                               
                            @endif
                            @csrf
                          </form>
                        <a href="{{route('product',['id' => $product->id,'type' => $product->type,'body' => $product->body])}}" class="nav-link color-second font-weight-bold">View Product</a>
                    </div>
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
<!-- !Top Sale -->