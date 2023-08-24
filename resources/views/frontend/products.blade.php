@extends('frontend.index')
@section('frontend')

<div id="grid"   >
   
    <style>
        
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-link {
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: default;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }


    }
    </style>
    <div class="pagination" >

    {{ $products->links() }}
    </div>
    

    @foreach($products as $row)
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
       
  

     
</div>


 



@endsection