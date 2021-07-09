<div class="container-fluid" style="background: #1a2236">
    <div class="d-flex justify-content-center pt-4">
        <h3 class="color-second font-weight-bold" style="border-bottom: 3px solid white">CATEGORY</h3>
    </div>
    <div class="row py-2 justify-content-center">
        @if ($categoryimages->count())
        @foreach ($categoryimages as $categoryimage)
        @if ($categoryimage->category == 'FIBER' | $categoryimage->category == 'DOWN' | $categoryimage->category == 'SILICON')
        <div class="p-2 parent-pos">
            <img class="w-100" src="data:image/jpeg;base64,{{base64_encode($categoryimage->image)}}" alt="">
            <a class="sale-btn nav-link text-light" href="{{route('shop.type',strtolower($categoryimage->category))}}">{{$categoryimage->category}}</a>
        </div>
        @endif
        @endforeach
        @else
        <div class="bg-white border mt-2">
            no image images
        </div>
        @endif
    </div>
</div>
