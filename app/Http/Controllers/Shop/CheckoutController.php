<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Orderbook;
use Stripe;
use Cart;

class CheckoutController extends Controller
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
    public function index(){
        $user = auth()->user();
        $addresses = Address::where('user_id',$user->id)->get();
        if(Cart::count()>0){
        return view('checkout.index',[
            'addresses' => $addresses,
        ]);
        }
        else{
            return redirect(route('cart.index'));
        }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->new_address == 'new') {
            $this->validate($request, [
                'name'=> 'required|max:255',
                'street'=> 'required|max:255',
                'city'=> 'required|max:255',
                'state'=> 'required|max:255',
                'zipcode'=> ['required','regex:/^(?:(?:[2-8]\d|9[0-7]|0?[28]|0?9(?=09))(?:\d{2}))$/'],
                'phone'=> ['required','regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/'],
                
            ]);
            $current_address = Address::create([
                'user_id'=>$request->user()->id,
                'email'=>$request->user()->email,
                'phone'=>$request->phone,
                'name'=>$request->name,
                'street'=>$request->street,
                'city'=>$request->city,
                'state'=>$request->state,
                'zipcode'=>$request->zipcode,
                'country'=>$request->country,
            ]);
        }
        else{
            $current_address = Address::find($request->address_id);
        }
        $contents = Cart::content()->map(function ($item) {
            return $item->id.', '.$item->name.', '.$item->qty;
        })->values()->toJson();
        $amount=Cart::total();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $intent = \Stripe\PaymentIntent::create([
            'amount'=> $amount*100,
            'currency'=>'AUD',
            'description' => 'Order',
            'receipt_email' => $current_address->email,
            'metadata' => [
                'integration_check'=>'accept_a_payment',
                'contents' => $contents,
                'quantity' => Cart::instance('default')->count(),
            ],
        ]);
        $data = array(
            'name'=>$current_address->name,
            'street'=>$current_address->street,
            'city'=>$current_address->city,
            'state'=>$current_address->state,
            'zipcode'=>$current_address->zipcode,
            'country'=>$current_address->country,
            'phone'=>$current_address->phone,
            'email'=>$current_address->email,
            'amount'=>$amount,
            'address_id'=>$current_address->id,
            'client_secret'=>$intent->client_secret,
        );
 
        return view('checkout.payment',[
            'data'=>$data
        ]);
    }
    public function success(Request $request){

        if(Cart::count()>0){
            
            $cart_items = [];
            $items = Cart::content();
            foreach ($items as $item)
            {
                $cart_items[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'size'=> $item->options->size,
                    'qty' => $item->qty,
                    'price'=>$item->price+$item->price*0.1,
                ];
            }
            $order = json_encode($cart_items);
            $checkout = Orderbook::create([
                'user_id'=>$request->user()->id,
                'address_id'=>$request->id,
                'order'=>$order,
                'payment'=>'Stripe',
            ]);
            Cart::destroy();
            return view('checkout.success');
        }
        else{
            return redirect(route('cart.index'));
        }
       
    }

}
