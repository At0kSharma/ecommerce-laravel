@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @if ($addresses->count()>0)
        <div class="col-sm-6 border  bg-white">
            <div class="p-2 m-2 border  shadow bg-secondary text-white">
                <span class="h5">Select Address</span>
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($addresses as $address)
                <div class="p-2 m-2 border  shadow bg-white d-flex flex-column" style="width: 16em">
                    <span>{{$address->name}}</span>
                    <span>{{$address->email}}</span>
                    <span>{{$address->phone}}</span>
                    <span>{{$address->street}}</span>
                    <span>{{$address->city}}</span>
                    <span>{{$address->state}}</span>
                    <span>{{$address->zipcode}}</span>
                    <span>{{$address->country}}</span>
                    <form action="{{route('checkout.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="address_id" value="{{$address->id}}">
                        <button type="submit" class="btn btn-primary btn-block" >Select</button>
                    </form>
                </div>
                @endforeach
            </div>
            
        </div>
        @endif
        <div class="col-sm-6 border  bg-white">
            <div class="p-2 m-2 border  shadow bg-secondary text-white">
                <span class="h5">New Address</span>
            </div>
            <form action="{{route('checkout.store')}}" method="post" id="payment-form">
                <div class="p-2">
                    <label for="email" >Your Email</label>
                    <input type="text" class="form-control" disabled value="{{ Auth::user()->email }}">
                    <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
                    @error('email')
                        <p class="  text-danger">This is a required field</p>                        
                    @enderror
                </div>
                <div class="p-2">
                    <label for="phone" >Phone number</label>
                    <input type="text" name="phone" id="phone" class="form-control  @error('phone') border-danger @enderror" required  value="{{ old('phone') }}">
                    @error('phone')
                        <p class="  text-danger">This is a required field</p>                        
                    @enderror
                </div>
                
                <div class="p-2">
                    <label for="name" >Full Name</label>
                    <input type="text" name="name" id="name" class="form-control  @error('name') border-danger @enderror" required  value="{{ old('name') }}">
                    @error('name')
                        <p class="  text-danger">This is a required field</p>                        
                    @enderror
                </div>
                <div class="p-2">
                    <label for="street" >Street Address</label>
                    <input type="text" name="street" id="street" class="form-control  @error('street') border-danger @enderror" required  value="{{ old('street') }}">
                    @error('street')
                        <p class="  text-danger">This is a required field</p>                        
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <label for="city" >City</label>
                        <input type="text" name="city" id="city" class="form-control  @error('city') border-danger @enderror" required  value="{{ old('city') }}">
                        @error('city')
                            <p class="  text-danger">This is a required field</p>                        
                        @enderror
                    </div>
                    <div class="p-2">
                        <label for="zipcode" >Zipcode</label>
                        <input type="text" name="zipcode" id="zipcode" class="form-control  @error('zipcode') border-danger @enderror" required  value="{{ old('zipcode') }}">
                        @error('zipcode')
                            <p class="  text-danger">This is a required field</p>                        
                        @enderror
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-2">
                        <label for="state" >State/Province</label>
                        <select name="state" id="state" class="form-control " required id="state">
                            <option value="">Please select a region, state or province</option>
                            <option value="australian_capital_territory">Australian Capital Territory</option>
                            <option value="jervis_bay_territory">Jervis Bay Territory</option>
                            <option value="new_south_wales">New South Wales</option>
                            <option value="northern_territory">Northern Territory</option>
                            <option value="queensland">Queensland</option>
                            <option value="south_australia">South Australia</option>
                            <option value="tasmania">Tasmania</option>
                            <option value="victoria">Victoria</option>
                            <option value="western_australia">Western Australia</option>
                        </select>
                        @error('state')
                            <p class="  text-danger">This is a required field</p>                        
                        @enderror
                    </div>
                    <div class="p-2">
                        <label for="country" >country</label>
                        <input type="text" class="form-control" disabled  value="Australia">
                        <input type="hidden" name="country" id="country"  value="AU">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group p-2 m-2">
                        <a href="{{route('cart.index')}}" class="btn btn-primary"><i class="pr-5 fas fa-chevron-left"></i>Cart</a>
                    </div>
                    <input type="hidden" name="new_address" value="new">
                    <div class="form-group p-2 m-2">
                        <button type="submit" class="btn btn-primary " >Payment<i class="pl-5 fas fa-chevron-right"></i></button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

@endsection

         