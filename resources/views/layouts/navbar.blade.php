<div class="container-fliud d-flex justify-content-center align-items-center p-2 ">
    <span class="h4">Winter Sale is on. Up to 30% off</span>
</div>
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
        <a class="navbar-brand d-flex" href="{{route('home.index')}}">
            <img src="{{asset('img/gt_logo.svg')}}" width="50" height="50" class="d-inline-block align-top" alt="">
            <span class="h4 mt-3">GurkhaTralis</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{route('shop.index')}}">All Product <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Women's
                    </a>
                    <div class="dropdown-menu p-0 m-0 color-second-bg border-0 rounded-0 " aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'down','body' => 'women'])}}">Down</a>
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'silicon','body' => 'women'])}}">Silicon</a>
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'fiber','body' => 'women'])}}">Fiber</a>
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'all','body' => 'women'])}}">Browser All</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Men's
                    </a>
                    <div class="dropdown-menu p-0 m-0 color-second-bg border-0 rounded-0" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'down','body' => 'men'])}}">Down</a>
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'silicon','body' => 'men'])}}">Silicon</a>
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'fiber','body' => 'men'])}}">Fiber</a>
                        <a class="dropdown-item text-white" href="{{route('shop.subgroup',['type' => 'all','body' => 'men'])}}">Browser All</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav">
                <div class="d-flex">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                        <li class="nav-item pr-2">
                            <a class="nav-link text-light " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item pr-2">
                            <a class="nav-link text-light " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else
                    <li class="nav-item pr-2">
                        <a @if (Auth::user()->is_admin)
                            href="{{route('dashboard')}}"
                        @else
                            href="{{route('user.index')}}"
                        @endif  class="nav-link text-light font-weight-bold">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item pr-2">
                        <a class="nav-link text-light" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </div>
            </ul>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item"> 
                @if (Cart::count())
                    <a href="{{route('cart.index')}}" class="p-1"><i class="fas fa-shopping-bag fa-lg text-white"> <span class="badge badge-light">{{Cart::count()}}</span></i></a>
                @else
                <a href="{{route('cart.index')}}" class="nav-link text-light"><i class="fas fa-shopping-bag fa-lg"></i> </a>    
                @endif
            </li>
        </ul>
    </nav>
</div>
    
   