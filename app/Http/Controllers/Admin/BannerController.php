<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

    }

    public function index(){
        $banner = Banner::get();
        return view('admin.banner', [
            'banner' =>$banner
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048|'
        ]);
        $banner = Image::make($request->banner)->resize(712, null, function ($constraint) {
            $constraint->aspectRatio();
        });  
        Response::make($banner->encode('jpg',100)); 
        Banner::create([
            'banner' => $banner,
        ]); 
        
        return back()->with('Success','banner Uploaded');

    }
    public function destroy(Request $request){
        $banner = Banner::find($request->id)->delete();
        return back()->with('success','Image Deleted');
    }
}
