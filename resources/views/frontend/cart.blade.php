@extends('frontend.index')
@section('frontend')
@php
  // to use the functions inside the trait Cart, it must be declared here
  use \App\Http\ShoppingCart\Cart;
@endphp
@if(isset($cart))
<div class="template-cart">
    
            

          <form action="{{ url('cart/update') }}" method="post">
           <!-- must put csrf inside the form tag to capture POST data -->
            @csrf
            <div class="table-responsive">
              <table class="table table-cart">
                <thead>
                  <tr>
                    <th class="image">Photo</th>
                    <th class="name" style="width:300px;">Name</th>
                    <th>Color</th>
                    <th>Size</th>

                    <th class="price">
                      Retail price
                    </th>
                    <th class="quantity" style="width: 50px;">Quantity</th>
                    <th class="price">Into money</th>
                    <th>Delete</th>
                  </tr>
              </thead>
              <tbody>
                @php
                $number=0;
                @endphp
               @foreach($cart as $product)
                <tr>
                  @php
                  $data=DB::table("products")->where("name","=",$product['name'])->first();
                  @endphp
                   
                  <td>
                    <a href="{{ url('detail/'.$data->id)}}">
                    <img src="{{$product['photo']}}" alt="" style="height:100px;">
                     </a>
                  </td>
                  
                  <td >
                   <a href="{{ url('detail/'.$data->id)}}" >{{$product['name']}}</a></td>
                  <td>{{$product['color']}}</td>
                  <td>{{$product['price']}}</td>
                  <td>{{$product['size']}}</td>
                  <td >   <input type="number" name="{{$number}}" value="{{$product['quantity']}}" style="width: 100px"></td>
                    @php
                    $key=$product['name'].$product['color'].$product['size'];
                    $number++;
                    @endphp
                  <td>{{number_format($product['quantity'] * $product['price'])}}</td>
                  <td><a href="{{ url('cart/remove/'.$key) }}" data-id="2479395"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
              </tbody>
              @if(Cart::cartNumber() > 0)
                <tfoot>
                  <tr>
                    <td colspan="10"><a href="{{ url('cart/destroy') }}" class="button pull-left">Delete all</a> <a href="{{ url('') }}" class="button pull-right black">Continue shopping</a>
                      <input type="submit" class="button pull-right" value="Update"></td>
                  </tr>
                </tfoot>
                @endif

          </table>
          @if(Cart::cartNumber() > 0)
          <div class="total-cart"> Total payment:
            {{ number_format(Cart::cartTotal()) }}₫ <br>
            <a href="{{ url('cart/order') }}" class="button black">Pay</a> </div>
        </div>
        @endif
      </div>
  </form>
</div>
@endif
@endsection
