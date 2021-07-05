@extends('admin.app')

@section('content')
    
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>update success</p>
        </div>
    @endif
    <div class="row">
        <div class="col-sm">
            <div class="border bg-white mt-2 p-3">
                <h5 for="banner">Banner Images</h5>
                <hr>  
                <!--Upload Image-->
                <form action="{{ route('admin.banner') }}" method="post" id="image_upload" enctype="multipart/form-data">
                    @csrf
                    <label for="banner" class="pl-2 ml-2">Add New Banner Image</label>
                    <input type="file" name="banner" class="form-control-file m-2 p-2" id="banner">
                    <button type="submit" name="banner-submit-btn " class="btn btn-primary pl-2 ml-2" >Submit</button>
                    @error('banner')
                        <p class=" m-2 text-danger">Upload Image</p>                        
                    @enderror
                </form>              
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            @if ($banner->count())
                <div class="d-flex flex-wrap justify-content-center bg-white border mt-2">
                    @foreach ($banner as $image)
                    <div class="shadow-sm  p-2">
                        {{-- {{$image_file = Image::make($image->image)}} --}}
                        <img src="data:image/jpeg;base64,{{base64_encode($image->banner)}}" style="width:24em;" alt="image">
                        <form action="{{route('delete.banner', $image->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="delete-image-submit"
                                onclick="return confirm('Are you sure?')"
                                class="btn btn-outline-danger btn-block" value="Delete Image ID-{{$image->id}}">
                        </form>
                    </div>                    
                    @endforeach
                </div>
            @else
            <div class="bg-white border mt-2">
                no banner images
            </div>
            @endif
        </div>
    </div>
</div>

@endsection