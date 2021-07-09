<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Categoryimage;
use Image;


class HomeController extends Controller
{
    
    public function index(){
        $categoryimages = Categoryimage::get();
        $products = Product::has('quantity')->inRandomOrder()->limit(4)->get();
        $banner = Banner::get();
        return view('layouts.index', [
            'products' =>$products,
            'banner' =>$banner,
            'categoryimages' => $categoryimages
        ]);
    }

}
