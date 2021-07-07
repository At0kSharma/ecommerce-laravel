@extends('layouts.app')

@section('content')

<!--   product  -->

<div class="container">
    <!--Product Route-->
    <div class="row">
        <div class="col-sm">
            <span class="text-secondary">
               home->{{$product->body}}->{{$product->type}}
            </span>
        </div>
    </div>

    <div class="row">
        <!--Image section-->
        <div class="col-sm-5 p-2">
            <div class="mobile-product-name ">
                <h2>{{$product->name}}</h2>
            </div>
            <div id="carousel-image" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @for ($i = 0; $i < $product->photo->count(); $i++)
                        @if ($i==0)
                        <div class="carousel-item active">
                            <img src="data:image/jpeg;base64,{{base64_encode($product->photo[$i]->image)}}" class="img-fluid"  alt="image">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="data:image/jpeg;base64,{{base64_encode($product->photo[$i]->image)}}" class="img-fluid"  alt="image">
                        </div>
                        @endif
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#carousel-image" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel-image" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
            </div>
        </div>
        <div class="col-sm-1">

        </div>
        <!--Product Datails-->
        <div class="col-sm-5 p-2">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-sm pt-4 desktop-product-name ">
                        <h2>{{$product->name}}</h2>
                        <p class="text-secondary">{{$product->id}}</p>
                    </div>
                </div>
                <!--rating and review-->
                <div class="row">
                    <div class="col-sm pl-3 pt-2">
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
                            <h6 class="p-1 text-success">{{$star}} {{ Str::plural('Star',$product->ratings->count()) }}</h6>
                            <h6 class="p-1">{{$product->ratings->count()}} {{ Str::plural('Review',$product->ratings->count()) }}</h6>
                            <a href="#rating_and_review" class="h6">Read Review of this product</a>              
                        @else
                            <div class="rating color-second">
                                <span><i class="far fa-star fa-lg"></i></span>
                                <span><i class="far fa-star fa-lg"></i></span>
                                <span><i class="far fa-star fa-lg"></i></span>
                                <span><i class="far fa-star fa-lg"></i></span>
                                <span><i class="far fa-star fa-lg"></i></span>
                            </div>
                            <a href="#rating_and_review" class="px-2 ">Be The First To Review</a>
                        @endif
                        
                    </div>
                </div>
                <hr>
                <!--Price -->
                <div class="row">
                    <div class="col-sm">
                        <h5>Our Price</h5>
                        <p class="pl-3 text-danger h6"><strike>${{$product->price}}</strike></p>
                        <p class="pl-3 text-success h5">A${{$product->price-($product->discount/100*$product->price)}}</p>
                    </div>
                </div>
                <hr>
               
                <!--Buy option-->
                <div class="row">
                    <div class="col-sm">
                        <!--Size -->
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <div class="d-flex mb-3">
                                @php 
                                    $available_size_array = [];
                                @endphp
                                {{-- available --}}
                                @if ($product->quantity->count()>0)
                                <div class="shadow text-center" style="height: 100px;"> 
                                    <h5>Avaliable</h5>
                                    <div class="d-flex p-2 m-2">
                                        @foreach ($product->quantity as $quantity)
                                            <div class="available_size text-center">
                                                <span class="h5">{{$quantity->size->size}}  
                                                <input type="radio" name="selected_size" checked value="{{$quantity->size->size}}">  
                                                </span> 
                                            </div> 
                                            @php
                                                $available_size_array[]= $quantity->size->size;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                {{-- unavailable --}}
                                @if ($all_size->count()!=$product->quantity->count())
                                <div class="text-center" style="height: 100px;"> 
                                    <h5>Not avaliable</h5>
                                    <div class="d-flex p-2 m-2">
                                        @foreach ($all_size as $unavailable)
                                            @if (in_array($unavailable->size,$available_size_array))
                                                @continue
                                            @endif
                                            <div class="available_size text-center text-secondary">
                                                <span class="h5 pt-3">{{$unavailable->size}}</span> 
                                            </div>   
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                
                                
                            </div>
                            <div class="form-row pt-4">
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="price" value="{{($product->price-($product->discount/100*$product->price))*100/110}}">
                                <input type="hidden" name="name" value="{{$product->name}}">
                                <div class="col">
                                    <button type="submit" @if($product->quantity->count() == 0) disabled @endif class="btn btn-primary form-control">Buy Now</button>
                                </div>
                                <div class="col">
                                    <button type="submit"  @if($product->quantity->count() == 0) disabled @endif class="btn btn-outline-primary form-control"> Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 ">
            <div class="text-center">
                <h5 class="">DESCRIPTION</h5>
                @if ($product->property != null)
                    <p class="text-secondary">{{$product->property->about}}</p>
                @else
                    <p class="text-secondary">Description will be add in few minutes</p>
                @endif
                
            </div>
            <hr>

            <div class="text-center">
                <h5 class="">FEATURES</h5>
                @if ($product->feature->count())
                    <div class=" m-1 p-1">
                    @foreach($product->feature as $feature)
                        <p class="text-secondary">{{$feature->feature}}</p>
                    @endforeach
                    </div>
                @else
                    <div class=" m-1 p-1">
                        <p class="text-secondary">Features will be add in few minutes</p>
                    </div>
                @endif
                
            </div>
            <hr>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-4">
            <div class="text-center">
                <h5 class="">SPECIFICATION</h5>
                @if ($product->property != null)
                    <div class="d-flex ">
                        <h5 class="text-secondary pr-3">Fabric :</h5>
                        <p class="text-secondary">{{$product->property->fabric}}</p>
                    </div>
                    <div class="d-flex ">
                        <h5 class="text-secondary pr-3">Weight : </h5>
                        <p class="text-secondary">{{$product->property->weight}}</p>
                    </div>
                    <div class="d-flex ">
                        <h5 class="text-secondary pr-3">Insulation : </h5>
                        <p class="text-secondary">{{$product->property->insulation}}</p>
                    </div>
                    <div class="d-flex ">
                        <h5 class="text-secondary pr-3">Sleeve : </h5>
                        <p class="text-secondary">{{$product->property->sleeve}}</p>
                    </div>
                    <div class="d-flex ">
                        <h5 class="text-secondary pr-3">Pocket : </h5>
                        <p class="text-secondary">{{$product->property->pocket}}</p>
                    </div>
                    <div class="d-flex ">
                        <h5 class="text-secondary pr-3">Closure : </h5>
                        <p class="text-secondary">{{$product->property->closure}}</p>
                    </div>
                @else     
                    <p class="text-secondary">Specifications will be add in few minutes</p>
                @endif    
            </div>
        </div>
    </div>
    
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8 ">
            <hr>
            <div class="text-center">
                <h5 class="">RECOMMENDATIONS</h5>
                <p class="text-secondary">Camping and Hiking</p>
                <p class="text-secondary">Urban and city life</p>
                <p class="text-secondary">commuting</p>
                <p class="text-secondary">winter</p>
            </div>
            <hr>

            <div class="text-center">
                <h5 class="">CARE INSTRUCTIONS</h5>
                <p class="text-secondary">Machine wash in cold water mild cycle</p>
                <p class="text-secondary">Do not Bleach</p>
                <p class="text-secondary">Do not use fabric softener</p>
                <p class="text-secondary">Wash with natural detergent(PH=7)</p>
                <p class="text-secondary">Wash with zipper,hood and loop fastener closed</p>
                <p class="text-secondary">Do not store when wet</p>
                <p class="text-secondary">Tumble dry on low heat</p>
                <p class="text-secondary">Do not Iron or Steam</p>
            </div>
           
        </div>
    </div>
</div>
<hr>
<div class="container" id="rating_and_review">
    <div class="row">
        <div class="col-sm-8">
            <div class="d-flex justify-content-between">
                <h4>Reviews and Ratings</h4>
            </div>
            <div class="p-2">
                @auth
                    @if (!$product->reviewBy(auth()->user()))
                        <form action="{{route('add.rating',$product->id)}}" method="post">
                            @csrf
                            <label for="review" class="p-0 m-0">Rate This Product</label>
                            <textarea type="text" id="review" name="review" class="form-control m-2 @error('review') border-danger @enderror" placeholder="Write you review" row="4">{{ old('review') }}</textarea>
                            @error('review')
                                <p class=" m-2 text-danger">Write somthing before posting</p>                        
                            @enderror
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <label for="star">Rating</label>
                                    <select class="form-control m-2" name="rating" id="rating">
                                        <option value="{{ old('rating') }}">{{ old('rating') ?? '--select--' }} </option>
                                        <option value="5">5</option>
                                        <option value="4.5">4.5</option>
                                        <option value="4">4</option>
                                        <option value="3.5">3.5</option>
                                        <option value="3">3</option>
                                        <option value="2.5">2.5</option>
                                        <option value="2">2</option>
                                        <option value="1.5">1.5</option>
                                        <option value="1">1</option>
                                    </select>
                                    @error('rating')
                                        <p class=" m-2 text-danger">Select</p>                        
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                @endauth
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="p-2">
                @if ($ratings->count())
                <div class="container mt-5">
                    <table class="table datatable" >
                        <tbody>
                            @foreach ($ratings as $rating)
                                    <tr>
                                        <div class="m-2 bg-white p-2 border">
                                            <div class="d-flex">
                                                <p class="h5 text-primary">{{$rating->user->name}}</p>
                                                <span class="pl-2 text-secondary">{{$rating->created_at->diffForHumans()}}</span>
                                            </div>
                                            
                                            <p class="pl-4 h5">{{$rating->rating}} Star Ratings</p>
                                            <p class="pl-4 bg-light" >{{$rating->review}}</p>
                                        </div>    
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="p-2 border">
                        <p>Be first to Submit a review of this Porduct</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<hr>
<div class="container pt-2">
    <div class="d-flex justify-content-between">
        <h4 class="h4">Similar Products</h4>
        <a href="{{route('shop.type',$product->type)}}" class="btn btn-outline-primary p-1 m-0">Explore</a>
    </div>
    <div class="row">
    <div class="col-sm-12 d-flex flex-wrap justify-content-center ">
        @foreach ($type as $product)
        <div class="card m-2 p-0 justify-content-between border-0 product-card text-center position-relative">
            <p class="position-absolute p-0 text-danger border border-danger">{{$product->discount}}% OFF</p>
            {{-- <p class="position-absolute p-1 text-primary" style="right:0;"><i class="fas fa-cart-plus fa-2x"></i></p> --}}
            <a href="{{route('product',['id' => $product->id,'type' => $product->type,'body' => $product->body])}}"><img class="card-img-top" src="data:image/jpeg;base64,{{base64_encode($product->preview)}}" alt="Card image cap"></a>
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

<!--   !product  -->

@endsection

         