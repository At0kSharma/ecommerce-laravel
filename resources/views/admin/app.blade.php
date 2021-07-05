<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gurkha Trails</title>
    @include('layouts.header')

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark color-second-bg shadow-sm">
        <div class="container d-flex justify-content-between">
                <!-- Left Side Of Navbar -->
                <ul class="d-flex m-0 p-0 align-items-center">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        GurkhaTrails
                    </a>
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
                            <a class="nav-link text-light">
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
                </ul>
            </div>
        </div>
    </nav>


    <div class="navbar navbar-expand-lg bg-light">
        <button type="button" id="sidebarCollapse" class="btn btn1 btn-outline-primary">
            <i class="fas fa-align-left"></i>
            <span>Menu</span>
        </button>
    </div>
    <div class="wrapper bg-light">
        <!-- Sidebar  -->
        <nav id="sidebar" class="pl-3 pt-2 pr-2">
    
        <div class="shadow-sm bg-white p-3 mb-3">
            <span>hello</span>
            <h4>Admin</h4>
        </div>
        <ul class="list-unstyled shadow-sm bg-white components p-3">
            <li>
                <a id="all-product" href="{{route('dashboard')}}" name="all-product" class="btn btn-outline-white shadow-none"> <i
                        class="pr-2 text-danger fas fa-server"></i>ALL PRODUCTS</a>
            </li>
            <li>
                <a id="add-product" href="{{route('addproduct')}}" name="add-product" class="btn btn-outline-white shadow-none"> <i
                        class="pr-2 text-danger fas fa-plus"></i>ADD PRODUCTS</a>
            </li>
            <hr>
            <li>
                <a id="order" href="{{route('orders.index','pending')}}" name="order" class="btn btn-outline-white shadow-none"> <i
                    class="pr-2 text-primary fas fa-shopping-bag"></i>PENDING</a>
            </li>
            <li>
                <a id="order" href="{{route('orders.index','shipping')}}" name="order" class="btn btn-outline-white shadow-none"> <i
                    class="pr-2 text-primary fas fa-shopping-bag"></i>SHIPPING</a>
            </li>
            <li>
                <a id="order" href="{{route('orders.index','complete')}}" name="order" class="btn btn-outline-white shadow-none"> <i
                    class="pr-2 text-primary fas fa-shopping-bag"></i>COMPLETE</a>
            </li>
            <li>
                <a id="order" href="{{route('orders.index','return')}}" name="order" class="btn btn-outline-white shadow-none"> <i
                    class="pr-2 text-primary fas fa-shopping-bag"></i>RETURN</a>
            </li>
            <hr>
            <li>
                <a id="banner" href="{{route('admin.banner')}}" name="banner" class="btn btn-outline-white shadow-none"> <i
                        class="pr-2 text-primary fas fa-image"></i>BANNER</a>
            </li>
            <hr>
            <li>
                <a id="misc." href="{{route('misc.index')}}" name="misc." class="btn btn-outline-white shadow-none"><i
                        class="pr-2 text-success fas fa-wallet"></i>MICS.</a>
            </li>
            <hr>
            <li>
                <a id="logout" name="logout" class="btn btn-outline-white shadow-none"><i
                        class="pr-2 text-danger fas fa-power-off"></i>LOGOUT</a>
            </li>
        </ul>
        </nav>
    
        <!-- Page Content  -->
        
            <div id="content">

                @yield('content')

            </div>
        
    </div>
    
    @include('layouts.footer')
</body>
</html>
