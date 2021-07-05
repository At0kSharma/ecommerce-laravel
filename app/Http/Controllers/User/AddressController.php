<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Address;

class AddressController extends Controller
{
    public function store(){
        $this->validate($request, [
            'name'=> 'required|max:255',
            'street'=> 'required|max:255',
            'city'=> 'required|max:255',
            'state'=> 'required|max:255',
            'zipcode'=> ['required','regex:/^(?:(?:[2-8]\d|9[0-7]|0?[28]|0?9(?=09))(?:\d{2}))$/'],
            'phone'=> ['required','regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/'],
            
        ]);
        if($request->add_address == 'checked'){
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

    }

    public function destroy(Request $request){
        $address = Address::find($request->id)->delete();
        return back()->with('success','Address deleted');
    }
}
