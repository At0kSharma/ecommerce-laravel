<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Orderbook;
use App\Models\Address;


class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

    }

    public function index($status){
        
        switch($status){
            case 'pending' :
                $id=0;
                break;
            case 'shipping' :
                $id=1;
                break;
            case 'complete' :
                $id=2;
                break;
            case 'return' :
                $id=3;
        }
        $orders = Orderbook :: where('status',$id)->latest()->get();
        return view('admin.orders',[
            'orders' => $orders,
            'status'=> $status,
        ]);

    }
    public function store(Request $request){
        
        Orderbook::where('id',$request->id)->update([
            'status'=>$request->status,
        ]);
        return back()->with('success','Order status updated!');
    }
}
