@extends('frontend.layouts.frontmaster')
@section('title','Bipow - One Product Store')
@push('css')
<script src="https://js.stripe.com/v3/"></script>
<style type="text/css" media="screen">
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  height: 50px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}
#card-errors{
    color:#fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
@endpush
@section('content')
    <!--Custom Banner-->
    <section class="section-padding dark-overlay" style="background: url(frontend/images/stripe2.png) no-repeat center center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 centered cl-white">
                    <div class="banner-title">
                        <h3>Stripe Payment</h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Custom Banner-->
    
    <!--Checkout area-->
    <section class="section-padding gray-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="checkout-card">
                        <div class="card">
                        <form id="payment-form" action="{{url('/stripe_payment')}}" method="POST" accept-charset="utf-8">
                            @csrf
                            <div class="card-header">
                                <h4>Payment Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="input-text">
                                    <label for="Name">NAME ON CARD</label>
                              
                                    <input type="text" class="input-text" id="name"
                                    name="name" Placeholder="Enter Name">
                                </div>

                                <div class="input-text">
                                    <label for="Name">Email</label>
                              
                                    <input type="text" class="input-text" id="email"
                                    name="email" Placeholder="Enter Email">
                                </div>
                                <div class="input-text">
                                    <label for="card-element">
                                      CREDIT OR DEBIT CARD
                                    </label>
                                    <div id="card-element">
                                      <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>

                                
                                
                                <button type="submit" class="bttn-small btn-fill">Place order</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <?php
                    $data = Session::get('shipping');
                    $collection = Cart::getContent();
                    $count = Cart::getContent();
                                  
                ?>
          
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="checkout-card">
                        <div class="card">
                            <div class="card-header">
                                <h4>Your order</h4>
                            </div>
                        @foreach($collection as $item)
                            <div class="card-body">
                                <div class="single-checkout-total">
                                    <p class="checkout-amount">Product</p>
                                    <p class="checkout-amount">Subtotal</p>
                                </div>
                                <div class="single-checkout-total">
                                    <p>{{$item->name}}  × {{$item->quantity}}</p>
                                    <p class="checkout-amount">${{$item->price}}</p>
                                </div>
                                <div class="single-checkout-total">
                                    <p class="checkout-amount">Subtotal</p>
                                    <p class="checkout-amount">${{Cart::getSubTotal()}}</p>
                                </div>
                                <div class="single-checkout-total">
                                    <p class="checkout-amount">Total</p>
                                    <h4 class="checkout-amount cl-primary">
                                          ${{Cart::getTotal()}}
                                    </h4>
                                </div>
                        @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/Checkout area-->

@endsection
@push('scripts')
<script>
(function(){
// Create a Stripe client.
var stripe = Stripe('pk_test_wBMGLwGmqIhiqH1XKE7cqnFb00dgqPK2CF');
// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '18px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style,
    hidePostalCode: true,
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();


  var options = {

     name: document.getElementById('name').value

  }

  stripe.createToken(card,options).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

})();

</script>
@endpush