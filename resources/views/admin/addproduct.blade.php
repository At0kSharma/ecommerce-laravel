@extends('admin.app')

@section('content')
    
<form action="{{ route('addproduct') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 shadow-sm bg-white m-2 p-4">
                <h3>Manage Product</h3>
                    <div class="border bg-light p-3">
                        <h6 class="text-primary">ADD A NEW PRODUCT</h6>
                        <div class="p-2">
                            <input type="text" name="name" class="form-control m-2 @error('name') border-danger @enderror" placeholder="Product Name" value="{{ old('name') }}">
                            @error('name')
                                <p class=" m-2 text-danger">Enter Product Name</p>                        
                            @enderror
                        </div>
                        <div class="d-flex ">
                            <div class="p-2">
                                <input type="text" name="type" class="form-control m-2 @error('type') border-danger @enderror " placeholder="Product Type" value="{{ old('type') }}">
                                @error('type')
                                    <p class=" m-2 text-danger">Enter Product Type</p>                        
                                @enderror
                            </div>
                            <div class="p-2">
                                <input type="number" name="price" class="form-control m-2 @error('price') border-danger @enderror " placeholder="Product Price" value="{{ old('price') }}">
                                @error('price')
                                    <p class=" m-2 text-danger">Enter Product Price</p>                        
                                @enderror
                            </div>
                            <div class="p-2">
                                <input type="number" name="discount" class="form-control m-2 @error('discount') border-danger @enderror " placeholder="Discount %" value="{{ old('discount') }}">
                                @error('discount')
                                    <p class=" m-2 text-danger">Enter Product Discount</p>                        
                                @enderror
                            </div>                      
                            
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
                        <div class=" pl-4  text-secondary form-group">
                            <label for="image">Select main image for the product</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                            @error('image')
                                <p class=" m-2 text-danger">Upload Image</p>                        
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group d-flex justify-content-center ">
                            <button name="add-product-submit" type="submit" class="btn btn-primary m-2"> Submit </button>
                        </div>                
                    </div>          
            </div>
        </div>
    </div>
</form>
@endsection