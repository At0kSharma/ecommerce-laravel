<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;

use App\Models\Quantity;
use App\Models\Size;

use Cart;

class CartController extends Controller
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
    {
        // dd('cart.index');
        $products = Product::get();
        $sizes = Size::get();
        $quantities = Quantity::get();
        return view('cart.index',[
            'products'=>$products,
            'sizes'=>$sizes,
            'quantities'=>$quantities
        ]);
    }

    public function store(Request $request)
    {
        $duplicate = Cart::search(function ($cartItem, $rowId) use($request){
            return $cartItem->id === $request->id;
        });

        if($duplicate->isNotEmpty()){
            return redirect()->route('cart.index')->with('success','Item is already in your cart');
        }
        cart::add($request->id, $request->name, 1, $request->price,['size' => $request->selected_size])
            ->associate('App\Product');
        return redirect()->route('cart.index')->with('success','Item was added to your cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success','Item has been removed!');
    }

}
