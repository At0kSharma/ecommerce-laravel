@extends('admin.app')



@section('content')
<div class="container-fluid">
    <div class="row mt-2 shadow-sm">
        <div class="col-sm-5 p-2 bg-white ">
            
            <div class="p-3 bg-white">
                <h3>Images </h3>
            </div>
            <div class="d-flex mt-2 p-3">
                <img class="border  p-2" src="data:image/jpeg;base64,{{base64_encode($item->preview)}}" style="width:12em;" alt="image">
                <form action="{{route('update.mainimage',$item->id)}}" method="post" enctype="multipart/form-data">
                    <div class=" pl-4  text-secondary form-group">
                        <label for="main_image">Change this image</label>
                        <input type="file" name="main_image" class="form-control-file" id="main_image">
                        @error('main_image')
                            <p class=" m-2 text-danger">Upload Image</p>                        
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center ">
                        <button type="submit" class="btn btn-primary m-2"> Submit </button>
                    </div>  
                    @csrf  
                </form>
            </div>
  
            <!--product images / delete-->
            <div class="border d-flex flex-wrap justify-content-center bg-white mt-2 p-3">
                @foreach ($photo as $image)
                <div class="shadow-sm  p-2">
                    {{-- {{$image_file = Image::make($image->image)}} --}}
                    
                    <img class="border  p-2" src="data:image/jpeg;base64,{{base64_encode($image->preview)}}" style="width:12em;" alt="image">
                    
                    <form action="{{route('delete.image', $image->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="delete-image-submit"
                            onclick="return confirm('Are you sure?')"
                            class="btn btn-outline-danger btn-block" value="Delete Image ID-{{$image->id}}">
                    </form>
                </div>                    
                @endforeach
            </div>
            <!--Images Details-->
            <div class="border bg-white mt-2 p-3">
                <!--Upload Image-->
                <form action="{{ route('update.image' , $item->id) }}" method="post" id="image_upload" enctype="multipart/form-data"
                    class="d-flex justify-content-between">
                    @csrf
                    <input type="file" name="image[]" id="img" multiple accept=".jpg, .png, .jpeg"
                        class="form-control m-2 " required>
                    <input type="submit" name="add-image-submit" id="add-image-submit"
                        class="btn btn-outline-primary m-2 " value="Upload">
                </form>              
            </div>
        </div>
        <div class="col-sm-6 p-2 bg-white ">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif

            {{-- product edit start --}}
            <div class="d-flex justify-content-between p-3 bg-white">
                <h3>Product </h3>
                <button id="edit-product-btn" type="submit" class="btn btn-outline-primary m-2">EDIT</button>
            </div>
            @if ($item != null)
                <form action="{{ route('update.product' , $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="border bg-light p-3">
                        <div class="p-2">
                            <label for="product_name" class="p-0 m-0">Product Name</label>
                            <input type="text" id="product_name" name="name" class="form-control m-2 @error('name') border-danger @enderror" disabled placeholder="Product Name" value="{{ $item->name }}">
                            @error('name')
                                <p class=" m-2 text-danger">Enter Product Name</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="product_type" class="p-0 m-0">Product Type</label>
                            <input type="text" id="product_type" disabled name="type" class="form-control m-2 @error('type') border-danger @enderror " placeholder="Product Type" value="{{ $item->type }}">
                            @error('type')
                                <p class=" m-2 text-danger">Enter Product Type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="Price" class="p-0 m-0">Price</label>
                            <input type="number" id="product_price" disabled name="price" class="form-control m-2 @error('price') border-danger @enderror " placeholder="Product Price" value="{{ $item->price }}">
                            @error('price')
                                <p class=" m-2 text-danger">Enter Product Price</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="Discount" class="p-0 m-0">Discount</label>
                            <input type="number" id="discount" disabled name="discount" class="form-control m-2 @error('discount') border-danger @enderror " placeholder="Discount %" value="{{ $item->discount }}">
                            @error('discount')
                                <p class=" m-2 text-danger">Enter Product Discount</p>                        
                            @enderror
                        </div>                      
                        <hr>
                        <p class="m-2 pl-3 font-size-14 text-secondary">Body type</p>
                        <div class="pl-4 d-flex">
                            <div class="pr-3">
                            <input type="radio" name="body" value="women"> Women
                            </div>
                            <div class="pr-3">
                            <input type="radio" name="body" value="men"> Men
                            </div>  
                            @error('body')
                                <p class=" m-3 text-danger">Select one</p>                        
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group d-flex justify-content-center ">
                            <button name="edit-product-submit" id="edit-product-submit" disabled type="submit" class="btn btn-primary m-2"> Submit </button>
                        </div>                
                    </div>    
                </form> 
            @else
                <div class="alert alert-success">
                    <p class="text-center h4 p-2 m-2">Product Not Available!</p>
                </div>
            @endif
            
            {{-- end product edit    --}}
            <div class="bg-light">
                <hr>
            </div>

            {{-- Quantity add start --}}

            <div class="border bg-light mt-2 p-3">
                <p class="m-2 pl-3 font-size-14 text-secondary"> QUANTITY </p>
                <div class="m-2 p-2 bg-light border">
                    @if ($quantity->count())
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quantity as $quantity_item)
                            <tr>
                                <td>
                                    @foreach ($size as $s)
                                    @if ($quantity_item->size_id==$s->id)
                                        {{$s->size}}                                            
                                    @endif
                                @endforeach
                                </td>
                                <td>{{$quantity_item->quantity}}</td>
                                <td><form action="{{ route('delete.quantity', $quantity_item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" name="delete-image-submit" onclick="return confirm('Are you sure?')" class="btn p-1 m-1 btn-outline-danger" value="Delete">
                                </form></td>
                            </tr>
                        </tbody>
                        @endforeach 
                    </table>                 
                    @else
                    <p class="m-2 p-2 bg-white">Quantity is zero</p>
                    @endif
                </div>
                @if ($item != null)
                    <form action="{{ route('update.quantity' , $item->id) }}" method="post" class="d-flex justify-content-between">
                        @csrf
                        <select name="size" id="size" class="form-control m-2" required>
                            @foreach ($size as $size_item)
                            <option value="{{$size_item->id}}">{{$size_item->size}}</option>
                            @endforeach
                        </select>

                        <input type="number" name="quantity" class="form-control m-2" required value="Quantity">

                        <input type="submit" name="add-quantity-submit" class="btn btn-outline-primary m-2"
                            value="Upload">
                    </form>
                @endif
                
            </div>

            {{-- End quantity add --}}

            <div class="bg-light">
                <hr>
            </div>

            {{-- start property edit --}}
            <div class="d-flex justify-content-between p-3 bg-white">
                <h3>Properties</h3>
                <button id="edit-property-btn" type="submit" class="btn btn-outline-primary m-2">EDIT</button>
            </div>
            @if ($item != null)
                <form action="{{ route('update.property' , $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="border bg-light p-3">
                        <div class="p-2">
                            <label for="fabric" class="p-0 m-0">Fabric</label>
                            <input type="text" id="fabric" name="fabric" class="form-control m-2 @error('fabric') border-danger @enderror" disabled placeholder="fabric" value="{{$property->fabric ?? ""}}">
                            @error('fabric')
                                <p class=" m-2 text-danger">Enter fabric type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="weight" class="p-0 m-0">Weight</label>
                            <input type="text" id="weight" name="weight" class="form-control m-2 @error('weight') border-danger @enderror" disabled placeholder="weight" value="{{$property->weight ?? ""}}">
                            @error('weight')
                                <p class=" m-2 text-danger">Enter weight type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="insulation" class="p-0 m-0">Insulation</label>
                            <input type="text" id="insulation" name="insulation" class="form-control m-2 @error('insulation') border-danger @enderror" disabled placeholder="insulation" value="{{$property->insulation ?? ""}}">
                            @error('insulation')
                                <p class=" m-2 text-danger">Enter insulation type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="sleeve" class="p-0 m-0">Sleeve</label>
                            <input type="text" id="sleeve" name="sleeve" class="form-control m-2 @error('sleeve') border-danger @enderror" disabled placeholder="sleeve" value="{{$property->sleeve ?? ""}}">
                            @error('sleeve')
                                <p class=" m-2 text-danger">Enter sleeve type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="closure" class="p-0 m-0">Closure</label>
                            <input type="text" id="closure" name="closure" class="form-control m-2 @error('closure') border-danger @enderror" disabled placeholder="closure" value="{{$property->closure ?? ""}}">
                            @error('closure')
                                <p class=" m-2 text-danger">Enter closure type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="pocket" class="p-0 m-0">Pocket</label>
                            <input type="text" id="pocket" name="pocket" class="form-control m-2 @error('pocket') border-danger @enderror" disabled placeholder="pocket" value="{{$property->pocket ?? ""}}">
                            @error('pocket')
                                <p class=" m-2 text-danger">Enter pocket type</p>                        
                            @enderror
                        </div>
                        <div class="p-2">
                            <label for="about" class="p-0 m-0">About Product</label>
                            <textarea type="text" id="about" name="about" class="form-control m-2 @error('about') border-danger @enderror" disabled placeholder="about" row="4">{{$property->about ?? ""}}</textarea>
                            @error('about')
                                <p class=" m-2 text-danger">Enter about type</p>                        
                            @enderror
                        </div>
                        
                        <div class="form-group d-flex justify-content-center ">
                            <button name="add-product-submit" id="edit-property-submit" disabled type="submit" class="btn btn-primary m-2"> Submit </button>
                        </div>                
                    </div>    
                </form>
            @endif
            
            {{-- end property edit --}}
            <div class="bg-light">
                <hr>
            </div>
            
             {{-- start Feature edit --}}
            <div class="d-flex justify-content-between p-3 bg-white">
                <h3>Features </h3>
                <button id="edit-feature-btn" type="submit" class="btn btn-outline-primary m-2">EDIT</button>
            </div>
            <div class="m-2 p-2 bg-light border">
                @if ($feature->count())
                @foreach ($feature as $point)
                <div class="d-flex justify-content-between">
                    <p class="m-2 p-2 bg-white">{{$point->feature ?? "There is no feature"}}</p>
                    <form action="{{ route('delete.feature', $point->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" name="delete-image-submit" onclick="return confirm('Are you sure?')" class="btn p-1 m-1 btn-outline-danger" value="Delete">
                    </form>
                </div>
                @endforeach 
                @else
                <p class="m-2 p-2 bg-white">There is no feature</p>
                @endif
            </div>
            @if ($item != null)
                <form action="{{ route('update.feature' , $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="field_wrapper">
                        <div class="input_fields_wrap">
                            <div class="d-flex">
                                <input type="text" id="mytext" name="mytext[]" disabled class="form-control m-2"
                                    placeholder="Add More Feature">
                                <a href="#" id="add_field_button" class="add_field_button m-2" disabled><i
                                        class="fas fa-plus-circle fa-2x text-primary"></i></a>
                            </div>
                        </div>
                        @error('mytext.*')
                        <p class=" m-2 text-danger">Don't submit empty field</p>                        
                        @enderror
                    </div> 
                    <div class="form-group d-flex justify-content-center ">
                        <button name="add-feature-submit" id="edit-feature-submit" disabled type="submit" class="btn btn-primary m-2"> Submit </button>
                    </div> 
                </form>
            @endif
            
            {{-- end feature edit --}}
            <div class="bg-light">
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection