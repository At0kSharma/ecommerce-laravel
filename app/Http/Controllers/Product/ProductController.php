<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Size;
use Image;
use Cart;


class ProductController extends Controller
{
    public function index(Request $request){
        $all_size = Size::get();
        $product = Product::with(['ratings','quantity','property','feature'])->find($request->id);
        $type = Product::limit(4)->where('type',$request->type)->get();
        $ratings = Rating::with('user')->latest()->where('product_id',$request->id)->get();
        return view('product.app',[
            'product'=>$product,
            'type' => $type,
            'ratings'=>$ratings,
            'all_size' =>$all_size,
        ]);
    }
    public function rating(Product $product ,Request $request){

        // dd($product->reviewBy($request->user()));

        $this->validate($request,[
            'review'=>'required|max:255',
            'rating'=>'required'
        ]);

        $product->ratings()->create([
            'user_id' => $request->user()->id,
            'review' => $request->review,
            'rating' => $request->rating
        ]);
         return back();
    }
}
