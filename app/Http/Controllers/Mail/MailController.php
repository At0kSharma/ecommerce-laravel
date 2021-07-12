<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Models\Orderbook;
use App\Models\Address;

class MailController extends Controller
{
    public function invoice($order_id){
        $order = Orderbook::find($order_id);
        $address = Address::find($order->address_id);
        $details = [
            'name'=>$address->name,
            'email'=>$address->email,
            'street'=>$address->street,
            'city'=>$address->city,
            'state'=>$address->state,
            'zipcode'=>$address->zipcode,
            'country'=>$address->country,
            'phone'=>$address->phone,
            'date'=>$order->created_at->format('Y-m-d'),
            'id'=>$order->id,
            'order'=>$order->order,
        ];
        Mail::to($address->email)->send(new InvoiceMail($details));
        return 'Check Your email';
    }
}
