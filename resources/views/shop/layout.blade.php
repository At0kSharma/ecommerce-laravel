@extends('layouts.app')

@section('content')
<div class="navbar navbar-expand-lg bg-white">
    <button type="button" id="sidebarCollapse" class="btn btn1 btn-outline-primary">
        <i class="fas fa-align-left"></i>
        <span>Menu</span>
    </button>
</div>
<div class="wrapper bg-white">
    <!-- Sidebar  -->
    <nav id="sidebar" class="pl-3 pt-2 pr-2">
    <ul class="list-unstyled shadow-sm bg-white components p-3">
        <li>
            <a href="{{route('shop.index')}}" class="btn btn-outline-white shadow-none">All Product</a>
        </li>
    </ul>
    <ul class="list-unstyled shadow-sm bg-white components p-3">
        <li>
            <a href="{{route('shop.subgroup',['type' => 'all','body' => 'men'])}}" class="btn btn-outline-white shadow-none">MEN</a>
            <ul class=" ml-4 list-unstyled">
                <li>
                    <a href="{{route('shop.subgroup',['type' => 'down','body' => 'men'])}}" class="btn btn-outline-white shadow-none">DOWN</a>
                </li>
                <li>
                    <a href="{{route('shop.subgroup',['type' => 'silicon','body' => 'men'])}}" class="btn btn-outline-white shadow-none">SILICON</a>
                </li>
                <li>
                    <a href="{{route('shop.subgroup',['type' => 'fiber','body' => 'men'])}}" class="btn btn-outline-white shadow-none">FIBER</a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="list-unstyled shadow-sm bg-white components p-3">
        <li>
            <a href="{{route('shop.subgroup',['type' => 'all','body' => 'women'])}}" class="btn btn-outline-white shadow-none">WOMEN</a>
            <ul class=" ml-4 list-unstyled">
                <li>
                    <a href="{{route('shop.subgroup',['type' => 'down','body' => 'women'])}}" class="btn btn-outline-white shadow-none">DOWN</a>
                </li>
                <li>
                    <a href="{{route('shop.subgroup',['type' => 'silicon','body' => 'women'])}}" class="btn btn-outline-white shadow-none">SILICON</a>
                </li>
                <li>
                    <a href="{{route('shop.subgroup',['type' => 'fiber','body' => 'women'])}}" class="btn btn-outline-white shadow-none">FIBER</a>
                </li>
            </ul>
        </li>
    </ul>
    </nav>
    <!-- Page Content  --> 
        <div id="content">
            @yield('product_area')
        </div>
</div>
    
@endsection