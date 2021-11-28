@extends('front.layout')
@section('page_title','Cart Page')
@section('container')

  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              @if(isset($carts[0]))
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>&nbsp;&nbsp;</th>
                         <th>&nbsp;&nbsp;&nbsp;</th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($carts as $data)
                       <tr id="cart_box{{$data->attr_id}}">
                         <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{$data->id}}','{{$data->size}}','{{$data->color}}','{{$data->attr_id}}')"><i class="fa fa-close"></i></a></td>
                         <td><a href="{{url('product/'.$data->slug)}}"><img src="{{asset('storage/media/'.$data->image)}}" alt="img"></a></td>
                         <td><a class="aa-cart-title" href="{{url('product/'.$data->slug)}}">{{$data->name}}</a>
                          @if($data->size!='')
                            <br>SIZE: {{$data->size}}
                          @endif
                          @if($data->color!='')
                            <br>COLOR: {{$data->color}}
                          @endif
                        </td>
                         <td>$ {{$data->price}}</td>
                         <td><input class="aa-cart-quantity" id="qty{{$data->id}}" onchange="updateQty('{{$data->id}}','{{$data->size}}','{{$data->color}}','{{$data->attr_id}}','{{$data->price}}')" type="number" name="qty" value="{{$data->qty}}"></td>
                         <td id="total_price{{$data->attr_id}}">$ {{$data->price*$data->qty}}</td>
                       </tr>
                       @endforeach
                       <tr>
                         <td colspan="6" class="aa-cart-view-bottom">
                           <a href="{{url('checkout')}}" class="aa-cart-view-btn">Checkout</a>
                         </td>
                       </tr>
                       </tbody>
                   </table>
                 </div>
              </form>
              @else
                <h4>Cart Empty</h4>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <input type="hidden" id="qty" name="qty" value="1">
  <form id="frmAddToCart">
    <input type="hidden" id="color_id" name="color_id">
    <input type="hidden" id="size_id" name="size_id">
    <input type="hidden" id="product_id" name="product_id">
    <input type="hidden" id="pqty" name="pqty">
    @csrf
   </form>
  <!-- / Cart view section -->
@endsection
