<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Categoryimage;
use Image;

class CategoryimageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

    }

    public function index(){

        $categoryimages = Categoryimage::get();
        return view('admin.misc',[
            'categoryimages' => $categoryimages,
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'category'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|'
        ]);

        if ($request->category == 'FIBER' | $request->category == 'DOWN' | $request->category == 'SILICON') {
           // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $image = Image::make($request->image)->resize(320, null, function ($constraint) {
                $constraint->aspectRatio();
            }); 
        }
        else{
           // resize the image to a width of 1440 and constrain aspect ratio (auto height)
           $image = Image::make($request->image)->resize(1440, null, function ($constraint) {
            $constraint->aspectRatio();
        }); 
        }
        Response::make($image->encode('jpg',100)); 
        Categoryimage::updateOrCreate(
            [
                'category'=>$request->category,
            ],
            [

                'image' => $image,
            ]
        ); 
        
        return back()->with('Success','image Uploaded');

    }
    public function destroy(Request $request){
        $image = Categoryimage::find($request->id)->delete();
        return back()->with('success','Image Deleted');
    }
}
