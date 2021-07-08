
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 p-0">
            <div id="carousel-image" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @for ($i = 0; $i < $banner->count(); $i++)
                        @if ($i==0)
                        <div class="carousel-item active">
                            <img  src="data:image/jpeg;base64,{{base64_encode($banner[$i]->banner)}}" class="img-fluid"  alt="image">
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="data:image/jpeg;base64,{{base64_encode($banner[$i]->banner)}}" class="img-fluid"  alt="image">
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-sm-9 p-0">
            <div class="women-section">
                <div class="text-women">
                    <span>UP TO</span><br>
                    <span>30% OFF</span><br>
                    <span>DOWN JACKETS</span><br>
                    <a href="{{route('shop.subgroup',['type' => 'down','body' => 'women'])}}" class="section-link">
                        <span>SHOP NOW</span>
                    </a>
                </div>
                <img src="{{asset('img/women.jpg')}}" alt="">
            </div>
            <div class="men-section">
                <div class="text-men">
                    <span>UP TO</span><br>
                    <span>30% OFF</span><br>
                    <span>DOWN JACKETS</span><br>
                    <a href="{{route('shop.subgroup',['type' => 'down','body' => 'men'])}}" class="section-link">
                        <span>SHOP NOW</span>
                    </a>
                </div>
                <img src="{{asset('img/men.jpg')}}" alt="">

            </div>
        </div>
    </div>
</div>

