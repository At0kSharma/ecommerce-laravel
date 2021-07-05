@extends('admin.app')

@section('content')
    
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>update success</p>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <div class="border bg-white mt-2 p-3">
                <h5 for="image">Category Images</h5>
                <hr>  
                <!--Upload Image-->
                <form action="{{ route('misc.store') }}" method="post" id="image_upload" enctype="multipart/form-data">
                    @csrf
                    <label for="image" class="pl-2 ml-2">Add New Image</label>
                    <input type="file" name="image" class="form-control-file m-2 p-2" id="image">
                    <div class="form-group">
                        <label for="category">Select category for image</label>
                        <select class="form-control" name="category" id="category">
                            <option value="">--select--</option>
                            <option value="DOWN">Down</option>
                            <option value="SILICON">Silicon</option>
                            <option value="FIBER">Fiber</option>
                        </select>
                    </div>
                    <button type="submit" name="image-submit-btn " class="btn btn-primary pl-2 ml-2" >Submit</button>
                    @error('image')
                        <p class=" m-2 text-danger">Upload Image</p>                        
                    @enderror
                </form>              
            </div>
        </div>
    </div>
    <div class="row p-2 justify-content-center">
        <div class="col-sm-10 d-flex">
            @if ($categoryimages->count())
            @foreach ($categoryimages as $categoryimage)
            <div class="m-2 text-center rounded" style="height: 21em; width: 14em;">
                <img class="w-100" src="data:image/jpeg;base64,{{base64_encode($categoryimage->image)}}" alt="">
                <h6>{{$categoryimage->category}}</h6>
            </div>
            @endforeach
            @else
            <div class="bg-white border mt-2">
                no image images
            </div>
            @endif
        </div>
        
    </div>
</div>

@endsection