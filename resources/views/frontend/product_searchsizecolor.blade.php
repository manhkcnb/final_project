@extends('frontend.index')
@section('frontend')
<div id="grid">
@if(!empty($check))
@foreach($check as $key)
    @php
    $row=DB::table("products")->where("id","=",$key)->first();
    @endphp

    
   
    <div class="product">
        <div class="info-large">
            <h4>{{$row->name}}</h4>
            <div class="sku">
                PRODUCT SKU: <strong>89356</strong>
            </div>
             
            <div class="price-big">
                <span></span> 
            </div>
             
          
            <h3>COLORS</h3>
            @php
                $product_if=\App\Http\Controllers\Frontend\indexController::product_if($row->id);
            @endphp
            <div class="colors-large">
                

               
        
            </div>

            <h3>SIZE</h3>
            <div class="sizes-large">
                <span>XS</span>
                <span>S</span>
                <span>M</span>
                <span>L</span>
                <span>XL</span>
                <span>XXL</span>
            </div>
            
            <button class="add-cart-large">Add To Cart</button>                          
                         
        </div>
        <div class="make3D">        
            <div class="product-front">
                <div class="shadow"></div>
                <a href="{{ url('detail/'.$row->id)}}">
                <img src="{{$row->photo}}" alt="" >
                </a>
                <div class="image_overlay"></div>
                <div class="add_to_cart">Add to cart</div>
                <div class="view_gallery">View gallery</div>
                <div class="stats">         
                    <div class="stats-container">
                        <a href="{{ url('detail/'.$row->id)}}">
                        <span class="product_price">{{ number_format($row->price) }} đ</span>
                        <span class="product_name">{{$row->name}}</span>    
                        <p>
                            @php
                                $category=\App\Http\Controllers\Frontend\indexController::readCategory($row->category_id);
                            @endphp
                            {{$category->name}}
                        </p>                                            
                        
                        <div class="product-options">
                        @php
                            $product_if=\App\Http\Controllers\Frontend\indexController::product_if($row->id);
                            $printedSizes = [];
                            $printColor = [];
                        @endphp
                        <strong>SIZES</strong>
                        <div style="display:flex;"> 
                        @foreach($product_if as $key)
                        @php
                            $sizes = \App\Http\Controllers\Frontend\indexController::getsSize($key->size_id);
                        @endphp
                        @if (!in_array($sizes->name, $printedSizes))
                            <div style="margin-right: 2px">{{$sizes->name}} </div>
                            @php
                                $printedSizes[] = $sizes->name;
                            @endphp
                        @endif
                        @endforeach
                        </div>
                        <strong>COLORS</strong>
                        
                        <div class="colors">
                            @foreach($product_if as $key)
                            @php
                                $colors=\App\Http\Controllers\Frontend\indexController::getsColor($key->color_id);
                            @endphp
                            @if(!in_array($colors->code,$printColor))
                                <div style="background:{{$colors->code}};border: 0.1px solid grey;"><span></span></div>
                                @php
                                    $printColor[] = $colors->code;
                                @endphp
                            @endif
                            @endforeach
                            
                        </div>
                    </div>
                    </a>                       
                    </div>                         
                </div>
            </div>
            
            <div class="product-back">
                <div class="shadow"></div>
                <div class="carousel">
                    <ul class="carousel-container">
                        <li><img src="{{$row->photo}}" alt="" /></li>
                    </ul>
                    <div class="arrows-perspective">
                        <div class="carouselPrev">
                            <div class="y"></div>
                            <div class="x"></div>
                        </div>
                        <div class="carouselNext">
                            <div class="y"></div>
                            <div class="x"></div>
                        </div>
                    </div>
                </div>
                <div class="flip-back">
                    <div class="cy"></div>
                    <div class="cx"></div>
                </div>
            </div>    
        </div>  
    </div>

@endforeach
@else
<h3>Không có sản phẩm nào</h3>
@endif

</div>



@endsection