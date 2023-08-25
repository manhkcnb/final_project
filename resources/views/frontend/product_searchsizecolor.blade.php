@extends('frontend.index')
@section('frontend')
<div id="grid">
@if(!empty($check))
@foreach($check as $key)
    @php
    $row = \App\Models\Product::with('category')
            ->where('id', $key)
            ->first();
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
                <img src="{{$row->photo}}" alt="" />
                <div class="image_overlay"></div>
                <a href="{{ url('detail/'.$row->id)}}"><div class="add_to_cart">Detail product</div></a>
                

                <div class="stats">         
                    <div class="stats-container">
                        <span class="product_price">{{ number_format($row->price) }} đ</span>
                        <span class="product_name">{{$row->name}}</span>    
                        <p>
                            
                            {{$row->category->name}}
                        </p> 
                        <div class="product-options">
                        @php
                            $product_if=$row->product_if;
                            $printedSizes = [];
                            $printColor = [];
                        @endphp
                        @if($product_if)
                            <strong>SIZES</strong>
                            <div style="display:flex;"> 
                            @foreach($product_if as $key)
                            
                            @if (!in_array($key->size->name, $printedSizes))
                                <div style="margin-right: 2px">{{$key->size->name}} </div>
                                @php
                                    $printedSizes[] = $key->size->name;
                                @endphp
                            @endif
                            @endforeach
                            </div>
                            <strong>COLORS</strong>
                        
                            <div class="colors">
                                @foreach($product_if as $key)
                                
                                @if(!in_array($key->color->code,$printColor))
                                    <div style="background:{{$key->color->code}};border: 0.1px solid grey;"><span></span></div>
                                    @php
                                        $printColor[] = $key->color->code;
                                    @endphp
                                @endif
                                @endforeach
                                
                            </div>
                        @endif
                       
                    </div>
                                                        
                        
                                               
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