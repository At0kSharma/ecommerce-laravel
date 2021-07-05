<div class="container sale-image-container">
    @if ($categoryimages->count())
    @foreach ($categoryimages as $categoryimage)
    @if ($categoryimage->category == 'SALE')
        <img class="sale-image br-20" src="data:image/jpeg;base64,{{base64_encode($categoryimage->image)}}" alt="">
    @endif
    @endforeach
    @endif
    <a href="#" class="sale-link nav-link">
        <span>SALE! SALE! SALE!</span>
        <span>Winter Sale is on. Up to 30% off</span>
    </a>
    @auth
    @if (Auth::user()->is_admin)
        <!-- Button trigger modal -->
        <button type="button" class="btn sale-image-edit" data-toggle="modal" data-target="#sale-image-edit">
            <i class="fas fa-pen"></i>
        </button>
        
        <!-- Modal -->
        <div class="modal fade " id="sale-image-edit" tabindex="-1" aria-labelledby="sale-image-edit-Label" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="sale-image-edit-Label">Change Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('misc.store') }}" method="post" id="image_upload" enctype="multipart/form-data">
                    @csrf
                    <label for="image" class="pl-2 ml-2">Add New Image<br>H:480px W:960px and size (<100KB)</label>
                    <input type="file" name="image" class="form-control-file m-2 p-2" id="image">
                    <input type="hidden" name="category" value="SALE">
                    @error('image')
                        <p class=" m-2 text-danger">Upload Image</p>                        
                    @enderror
                     
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="image-submit-btn " class="btn btn-primary pl-2 ml-2" >Submit</button>
                </div>
            </form>    
            </div>
            </div>
        </div>
    @endif
    @endauth  
</div>