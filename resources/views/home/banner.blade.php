
<div class="container pt-2">
    <div class="row">
        <div class="col-sm-8 p-3">
            <img src="{{asset('img/image2.jpg')}}" alt="" class="w-100 br-20">
        </div>
        <div class="col-sm-4 p-3">
            <div id="carousel-image" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @for ($i = 0; $i < $banner->count(); $i++)
                        @if ($i==0)
                        <div class="carousel-item active">
                            <img  src="data:image/jpeg;base64,{{base64_encode($banner[$i]->banner)}}" class="img-fluid br-20"  alt="image">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="data:image/jpeg;base64,{{base64_encode($banner[$i]->banner)}}" class="img-fluid br-20"  alt="image">
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

