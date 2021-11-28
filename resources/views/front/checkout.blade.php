@extends('front.layout')
@section('page_title','Checkout Page')
@section('container')
 <!-- Cart view section -->
 <section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form id="frmCheckout">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <!-- Login section -->
                    @if (session()->has('FRONT_USER_LOGIN')==null)
                    <a class="aa-browse-btn" href="javascript:void(0)" data-toggle="modal" data-target="#login-modal">
                      Login
                    </a>
                    <br><br>
                    OR
                    <br><br>
                    @endif
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Billing Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" aria-expanded="true">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Name*" name="name" value="{{$customer['name']}}" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email Address*" name="email" value="{{$customer['email']}}" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Phone*" name="mobile" value="{{$customer['mobile']}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="address" placeholder="Address*" required>{{$customer['address']}}</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="City / Town*" name="city" value="{{$customer['city']}}" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="State*" name="state" value="{{$customer['state']}}" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*" name="zip" value="{{$customer['zip']}}" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $totalprice=0;
                        @endphp
                        @foreach ($cart_data as $list)
                        @php
                            $totalprice=$totalprice+($list->price*$list->qty);
                        @endphp
                          <tr>
                            <td>{{$list->name}} <strong> x  {{$list->qty}}</strong>
                            <br>
                            <span class="checkout-color">{{$list->color}}</span>
                            </td>
                            <td>$ {{$list->price*$list->qty}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                         <tr class="hide show_code">
                          <th>Coupon Code <a id="removeCode" href="javascrip:void(0)" onclick="removeCouponCode()">Remove</a></th>
                          <td id="coupon_code_str"></td>
                        </tr>
                         <tr>
                          <th>Total</th>
                          <td id="totalPrice">$ {{$totalprice}}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Coupon Code</h4>
                  <div class="aa-payment-method">
                    <input id="coupon_code" name="coupon_code" class="coupon-code coupon_input" type="text" placeholder="Coupon Code">
                    <input style="width:100%;margin-top:5px" type="button" onclick="applyCouponCode()" value="Apply Coupon" class="aa-browse-btn coupon_input">
                    @csrf
                    <div id="coupon_msg"></div>
                  </div>
                  <br>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="payment_type" value="COD" checked> Cash on Delivery </label>
                    <label for="paypal"><input type="radio" id="paypal" name="payment_type" value="Gateway"> Via Paypal </label>
                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">
                    <button id="orderPlaceOrder" type="submit" value="Place Order" class="aa-browse-btn">Place Order <img id="reg_loading" style="display:none;width:15px" src="{{asset('front_assets/img/loading.gif')}}"></button>
                    <div id="orderPlaceError"></div>
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
@endsection
