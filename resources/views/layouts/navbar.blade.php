<div class="container-fliud d-flex justify-content-center align-items-center">
    <span>%OFF IN AUSTRALIA</span>
</div>
<div class="header">
    <!--top nav bar-->
    <div>

    
    <nav class="navbar navbar-expand-md navbar-dark color-second-bg shadow-sm">
        <div class="container d-flex justify-content-between">
            <!-- Left Side Of Navbar -->
            <ul class="d-flex m-0 p-0 align-items-center">
                <img src="{{asset('img/logo_gt.png')}}" style="width:3rem;" alt="">
                <a class="navbar-brand" href="{{ url('/') }}">GurkhaTrails</a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="d-flex m-0 p-0 list-unstyled align-items-center">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a @if (Auth::user()->is_admin)
                            href="{{route('dashboard')}}"
                        @else
                            href="{{route('user.index')}}"
                        @endif  class="nav-link text-light">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li>
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
                    <li class="nav-item dropdown"> 
                    @if (Cart::count())
                        <a href="{{route('cart.index')}}" class="btn btn-light">cart- 
                            <span>{{Cart::count()}}</span>
                        </a>
                    @else
                    <a href="{{route('cart.index')}}" class="nav-link text-light">cart </a>    
                    @endif
                    </li>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </ul>
            </div>
        </div>
    </nav>
    <!--second navbar-->
    <nav class="navbar navbar-expand-md navbar-dark color-second-bg shadow-sm">
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('shop.index')}}">All Product <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Top Sale</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">New Arival</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Women's
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'down','body' => 'women'])}}">Down</a>
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'silicon','body' => 'women'])}}">Silicon</a>
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'fiber','body' => 'women'])}}">Fiber</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'all','body' => 'women'])}}">Browser All</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Men's
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'down','body' => 'men'])}}">Down</a>
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'silicon','body' => 'men'])}}">Silicon</a>
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'fiber','body' => 'men'])}}">Fiber</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('shop.subgroup',['type' => 'all','body' => 'men'])}}">Browser All</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline ">
                <div class="form-group mb-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-sm btn-outline-success ml-2 my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </div>     
            </form>
        </div>
        
    </nav>
</div>
</div>
    
   