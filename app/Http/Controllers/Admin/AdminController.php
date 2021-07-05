<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Property;
use App\Models\Feature;
use App\Models\Quantity;
use App\Models\Size;
use Image;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

    }

    // ADMIN Homepage
    public function index(){

        $products = Product::latest()->get();
        return view('admin.dashboard', [
            'products' =>$products
        ]);
    }
    // add-product page
    public function addproduct(){
        
        return view('admin.addproduct');
    }
    // add product to database
    public function store(Request $request){
        
        $this->validate($request, [
            'name'=> 'required|max:255',
            'price'=> 'required',
            'discount'=> 'required',
            'type'=> 'required|max:255',
            'body'=> 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|'
        ]);

        $height = Image::make($request->image)->height();
        $width = Image::make($request->image)->width();
        if($height>$width){
            $original = Image::make($request->image)->resize(null, 1060, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($original->encode('jpeg',100));
            $preview = Image::make($request->image)->resize(null, 712, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($preview->encode('jpeg',100));
            $thumb = Image::make($request->image)->resize(null, 120, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($thumb->encode('jpeg',100));
        }
        else{
            $original = Image::make($request->image)->resize(1060, null, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($original->encode('jpeg',100));
            $preview = Image::make($request->image)->resize(712, null, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($preview->encode('jpeg',100));
            $thumb = Image::make($request->image)->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($thumb->encode('jpeg',100));
        }
        Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'discount'=> $request->discount,
            'type'=> $request->type,
            'body'=> $request->body,
            'image' => $original,
            'preview' => $preview,
            'thumbnail' => $thumb,
        ]); 

        $products = Product::get();
        
        return view('admin.dashboard', [
            'products' =>$products
        ]);
    }

    
    //delete product
    public function destroy(Request $request){
        dd($request->id);
        $product = Product::find($request->id)->delete();
        return back();
    }

    //edit 
    public function edit(Request $request){
        $product = Product::find($request->id);
        $size = Size::get();
        $qunatity = Quantity::where('product_id',$request->id)->get();
        $photo = Photo::where('product_id',$request->id)->get();
        $property = Property::where('product_id',$request->id)->get()->first();
        $feature = Feature::where('product_id',$request->id)->get();

        // dd($property);
        return view('admin.edit', [
            'item' =>$product,
            'property'=>$property,
            'feature'=>$feature,
            'size' =>$size,
            'quantity' =>$qunatity,
            'photo' =>$photo
        ]);
    }

}
