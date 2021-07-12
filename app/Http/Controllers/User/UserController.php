<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Address;
use App\Models\Orderbook;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = auth()->user();
        $addresses = Address::where('user_id',$user->id)->get();
        $orders = Orderbook::where('user_id',$user->id)->get();
        return view('user.index',[
            'addresses' => $addresses,
            'orders'=>$orders
        ]);
    }
}
