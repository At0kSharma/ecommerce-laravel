<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Photo;
use Image;

class PhotoController extends Controller
{
    public function index(){

    }
    
    public function store(Request $request){
        // $image = Productimage::get();
        $this->validate($request, [
            'image.*' => 'required|image|mimes:jpeg,png,jpg|max:2048|'
        ]);
        
        foreach($request->image as $images)
        {
            $height = Image::make($images)->height();
            $width = Image::make($images)->width();
            if($height>$width){
                $original = Image::make($images)->resize(null, 1060, function ($constraint) {
                    $constraint->aspectRatio();
                });  
                Response::make($original->encode('jpeg',100));
                $preview = Image::make($images)->resize(null, 712, function ($constraint) {
                    $constraint->aspectRatio();
                });  
                Response::make($preview->encode('jpeg',100));
                $thumb = Image::make($images)->resize(null, 120, function ($constraint) {
                    $constraint->aspectRatio();
                });  
                Response::make($thumb->encode('jpeg',100));
            }
            else{
                $original = Image::make($images)->resize(1060, null, function ($constraint) {
                    $constraint->aspectRatio();
                });  
                Response::make($original->encode('jpeg',100));
                $preview = Image::make($images)->resize(712, null, function ($constraint) {
                    $constraint->aspectRatio();
                });  
                Response::make($preview->encode('jpeg',100));
                $thumb = Image::make($images)->resize(120, null, function ($constraint) {
                    $constraint->aspectRatio();
                });  
                Response::make($thumb->encode('jpeg',100));
            }
            

            Photo::create([
                'product_id'=> $request->id,
                'image' => $original,
                'preview'=>$preview,
                'thumbnail'=>$thumb,
            ]); 
        }
        return back()->with('success','The Image Added successfully');
        
    }
    public function destroy(Request $request){
        $image = Photo::find($request->id)->delete();
        return back()->with('success','Image Deleted');
    }
}
