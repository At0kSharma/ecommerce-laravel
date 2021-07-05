<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;


class ShopController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('shop.index',[
            'products' =>$products
        ]);
    }
    public function subgroup(Request $request){
        if($request->type == 'all'){
            $products = Product::where('body',$request->body)->get();
        }else{
            $products = Product::where('type',$request->type)->where('body',$request->body)->get();
        }
        return view('shop.index',[
            'products' =>$products
        ]);
    }
    public function type(Request $request){
        
        $products = Product::where('type',$request->type)->get();
        
        return view('shop.index',[
            'products' =>$products
        ]);
    }
}
