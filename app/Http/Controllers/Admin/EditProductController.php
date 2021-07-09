<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Images;
use App\Models\Property;
use App\Models\Feature;
use App\Models\Quantity;
use App\Models\Size;
use Image;


class EditProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

    }

    //edit product
    public function index(Request $request){
        
    }

    public function product(Request $request){
        $this->validate($request, [
            'name'=> 'required|max:255',
            'price'=> 'required',
            'discount'=> 'required',
            'type'=> 'required|max:255',
            'body'=> 'required|max:255',
        ]);
        
        Product::where('id',$request->id)->update([
            'name'=> $request->name,
            'price'=> $request->price,
            'discount'=> $request->discount,
            'type'=> $request->type,
            'body'=> $request->body,
        ]);

        return back()->with('success','The product update successfully');
    }


    public function productimage(Request $request){
        $this->validate($request, [
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048|'
        ]);
        $height = Image::make($request->main_image)->height();
        $width = Image::make($request->main_image)->width();
        if($height>$width){
            $original = Image::make($request->main_image)->resize(null, 1060, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($original->encode('jpeg',100));
            $preview = Image::make($request->main_image)->resize(null, 712, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($preview->encode('jpeg',100));
            $thumb = Image::make($request->main_image)->resize(null, 120, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($thumb->encode('jpeg',100));
        }
        else{
            $original = Image::make($request->main_image)->resize(1060, null, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($original->encode('jpeg',100));
            $preview = Image::make($request->main_image)->resize(712, null, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($preview->encode('jpeg',100));
            $thumb = Image::make($request->main_image)->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            });  
            Response::make($thumb->encode('jpeg',100));
        }
        Product::where('id',$request->id)->update([
            'image' => $original,
            'preview' => $preview,
            'thumbnail' => $thumb,
        ]);

        return back()->with('success','The Image update successfully');
    }

    public function property (Request $request){

        // $property = Property::where('product_id',$request->id)->get();
        // dd($property);
        $this->validate($request, [
            'fabric'=> 'required|max:255',
            'weight'=> 'required|max:255',
            'insulation'=> 'required|max:255',
            'sleeve'=> 'required|max:255',
            'closure'=> 'required|max:255',
            'pocket'=> 'required|max:255',
            'about'=> 'required|max:1255',
        ]);
        
        Property::updateOrCreate(
            [
                'product_id' =>$request->id,
            ],
            [
                'fabric'=> $request->fabric,
                'weight'=> $request->weight,
                'insulation'=> $request->insulation,
                'sleeve'=> $request->sleeve,
                'closure'=> $request->closure,
                'pocket'=> $request->pocket,
                'about'=> $request->about,
            ]
        );

        return back()->with('success','The product update successfully');
    }
    public function feature (Request $request){

        $this->validate($request, [
            'mytext.*'=> 'required|max:255',
        ]);
        
        // dd($request->mytext);
        foreach($request->mytext as $text){
            feature::Create(
                [
                    'product_id' =>$request->id,
                    'feature'=> $text,
                ]
            );
        }
        

        return back()->with('success','The product update successfully');
    }

    //delete feature
    public function destroy(Request $request){

        $product = Feature::find($request->id)->delete();
        return back();
    }


    //update Quantity
    public function quantity(Request $request){

        $this->validate($request, [
            'size'=> 'required',
            'quantity'=> 'required|not_in:0',
        ]);
        
        Quantity::updateOrCreate(
            [
                'product_id' =>$request->id,
                'size_id'=> $request->size,
            ],
            [
                'quantity'=> $request->quantity,
            ]
        );
        return back()->with('success','The product update successfully');
    }

    public function destroyquantity(Request $request){
        
        $query = Quantity::find($request->id)->delete();
        return back();
    }

}
