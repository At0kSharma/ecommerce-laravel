@extends('layouts.app')

@section('content')
<style>
    /* todo: spinner/processing state, errors, animations */

.spinner,
.spinner:before,
.spinner:after {
  border-radius: 50%;
}
.spinner {
  color: #ffffff;
  font-size: 22px;
  text-indent: -99999px;
  margin: 0px auto;
  position: relative;
  width: 20px;
  height: 20px;
  box-shadow: inset 0 0 0 2px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.spinner:before,
.spinner:after {
  position: absolute;
  content: "";
}
.spinner:before {
  width: 10.4px;
  height: 20.4px;
  background: var(--accent-color);
  border-radius: 20.4px 0 0 20.4px;
  top: -0.2px;
  left: -0.2px;
  -webkit-transform-origin: 10.4px 10.2px;
  transform-origin: 10.4px 10.2px;
  -webkit-animation: loading 2s infinite ease 1.5s;
  animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
  width: 10.4px;
  height: 10.2px;
  background: var(--accent-color);
  border-radius: 0 10.2px 10.2px 0;
  top: -0.1px;
  left: 10.2px;
  -webkit-transform-origin: 0px 10.2px;
  transform-origin: 0px 10.2px;
  -webkit-animation: loading 2s infinite ease;
  animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

/* Animated form */

.sr-root {
  animation: 0.4s form-in;
  animation-fill-mode: both;
  animation-timing-function: ease;
}

.hidden {
  display: none;
}

@keyframes field-in {
  0% {
    opacity: 0;
    transform: translateY(8px) scale(0.95);
  }
  100% {
    opacity: 1;
    transform: translateY(0px) scale(1);
  }
}

@keyframes form-in {
  0% {
    opacity: 0;
    transform: scale(0.98);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

</style>

<div class="container ">
    <div class="row ">
        <div class="col-sm-7 bg-white ">
            <p class="h5 pt-2">Payment Details</p>
            <table class="table" >
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th> 
                        <th>Rate</th> 
                    </tr>                
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->options->size}}</td>
                                <td class="text-right" >A${{number_format($item->price,2)}}</td>
                                <td>{{$item->qty}}</td>
                                <td class="text-right" >A${{number_format(($item->qty*$item->price),2)}}</td>
                            </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Subtotal</td>
                        <td></td>
                        <td></td>
                        <td class="text-right" >A${{number_format(Cart::subtotal(),2)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>GST (10%)</td>
                        <td></td>
                        <td></td>
                        <td class="text-right" >A${{number_format(Cart::tax(),2)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Shipping</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">A$0.00</td>
                    </tr>
                    <tr class="bg-secondary text-success">
                        <td></td>
                        <td class="h5">Grand Total</td>
                        <td></td>
                        <td></td>
                        <td class="text-right h5" >A${{number_format(Cart::total(),2)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4 ml-2 bg-white ">
            <div class="form-group pt-2">
                <label class="h5" for="term_conditions">Terms of Service</label>
                <textarea class="form-control" id="term_conditions" rows="3">Gurkhas trails was established with a vision of providing quality at the most affordable prices. At Gurkha Trails we are committed to be honest, Open and Fair deals with all our customers. At Gurkhas Trails we take full responsibility to protect personal information of our customers under applicable privacy laws in respect of the collection, use, disclosure and management of customers personal information. 
                    The Privacy Policy Describes how Gurkha Trails will manage your personal Information which we collect about our customers via the use of our websites, social media pages and other formal or informal forms of interactions with us. At Gurkha Trails we are aware and committed to protect the privacy of your information.
                   If under any circumstances you believe that we have breached your privacy rights, or you have any queries regarding our Privacy Policy, please feel free to Contact Us. The privacy policy is subject to our Terms and Conditions.
                   At Gurkhas Trails we value feedback and ideas of every single customers.</textarea>
            </div>
            <div class="form-check mb-5">
                <input type="checkbox" class="form-check-input" name="term_of_service" id="term_of_service">
                <label class="form-check-label" for="term_of_service">Agree to Terms of service</label>
            </div>
            <form id="payment-form">
                <div class="form-group">
                    <label for="card-element">
                      Credit or debit card
                    </label>
                    <div id="card-element">
                      <!-- a Stripe Element will be inserted here. -->
                    </div>
    
                    <!-- Used to display form errors -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="sr-field-error" id="card-errors" role="alert"></div>
                <button type="submit" id="submit">
                  <div class="spinner hidden" id="spinner"></div>
                  <span id="button-text">Pay</span><span id="order-amount"></span>
                </button>
            </form>
        </div>
    </div>
</div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
    var stripe = Stripe('pk_test_51IwIW0EliTywcOl7RyTxllMjSA1253rhAqwXaXTPW6GMzQSZLRWdtU1ccrgIIZXbpt2zM1Ov2VycOgU11uwCOiru00dqVEM5ZB');

    var elements = stripe.elements();

    // Set up Stripe.js and Elements to use in checkout form
    var style = {
    base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
        color: "#aab7c4"
        }
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
    },
    };

    var cardElement = elements.create('card', {style: style});
    cardElement.mount('#card-element');

    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) { 
    // We don't want to let default form submission happen here,
    // which would refresh the page.
    event.preventDefault();

    stripe.confirmCardPayment('{{ $data["client_secret"] }}',{
        payment_method: {
            card: cardElement,
            billing_details: {
                name:'{{ $data["name"] }}',
                email:'{{ $data["email"] }}',
                phone:'{{ $data["phone"] }}',
                address:{
                  line1:'{{ $data["street"] }}',
                  city:'{{ $data["city"] }}',
                  state:'{{ $data["state"] }}',
                  country:'{{ $data["country"] }}'
                }
            }
        },
        setup_future_usage: 'off_session'
    }).then(function(result){
        $('#spinner').css('display','block');
        if(result.error){
            $('#card-errors').text(result.error.message);
        }else{
            if(result.paymentIntent.status === 'succeeded'){
                $('#card-success').text("payment successfully done by sca");
                setTimeout(function(){ window.location.href = "{{route('checkout.success',['id'=>$data['address_id']])}}";}, 2000);
            }
            return false;
        }
    });
    });

    var showError = function(errorMsgText) {
    changeLoadingState(false);
    var errorMsg = document.querySelector(".sr-field-error");
    errorMsg.textContent = errorMsgText;
    setTimeout(function() {
        errorMsg.textContent = "";
    }, 4000);
    };
    // Show a spinner on payment submission
    var changeLoadingState = function(isLoading) {
    if (isLoading) {
        document.querySelector("button").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
    } else {
        document.querySelector("button").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
    };
    </script>

@endsection

         