<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Add to Cart Interaction Example</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/cart.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

</head>
<body>
<!-- partial:index.partial.html -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<div id="wrapper">
@include("frontend.header")

<div id="sidebar">
	<h3><a href="{{url('cart')}}">Cart</a></h3>
    <div class="cart-icon-top">
</div>

<div class="cart-icon-bottom">
</div>
   <!--  <div id="cart">
    	<span class="empty">No items in cart.</span>       
    </div> -->
    
    <h3>CATEGORIES</h3>
    <div class="checklist ">
    	<ul>
        	@php
            $category=DB::table("category")->get();
            @endphp
            @foreach($category as $row)
            <li><a href="{{url('category/'.$row->id)}}"><span></span>{{$row->name}}</a></li>
            @endforeach
        </ul>
    </div>
    
    <h3>COLORS</h3>
    <div class="checklist colors">
        @php
            $color=DB::table("colors")->get();
            $check=ceil(count($color)/2);
        @endphp
    	<ul>
            
            @foreach($color as $key=>$row)
            @if($key<$check)
        	<li><a href="{{url('color/'.$row->id)}}"><span style="background:{{$row->code}};border: 0.1px solid grey;"></span>{{$row->name}}</a></li>
            @endif
            @endforeach
            
        </ul>
        <ul>
            @foreach($color as $key=>$row)
            @if($key>=$check)
            <li><a href="{{url('color/'.$row->id)}}"><span style="background:{{$row->code}};border: 0.1px solid grey;"></span>{{$row->name}}</a></li>
            @endif
            @endforeach
        </ul>
        
              
    </div>
    
    <h3>SIZES</h3>
    @php
        $size=DB::table("size")->get();
        $check=ceil(count($size)/2);
    @endphp
    <div class="checklist sizes">
    	<ul>
            @foreach($size as $key=>$row)
            @if($key<$check)
        	<li><a href="{{url('size/'.$row->id)}}"><span></span>{{$row->name}}</a></li>
            @endif
            @endforeach
        </ul>
        <ul>
            @foreach($size as $key=>$row)
            @if($key<$check)
            <li><a href="{{url('size/'.$row->id)}}"><span></span>{{$row->name}}</a></li>
            @endif
            @endforeach
        </ul>   

        
     
    </div>
    
     <h3>PRICE RANGE</h3>
    <form class="form-inline" method="GET" action="searchPrice">
        <div class="form-row align-items-center" style="display:flex;">
            
                <label for="min_price" class="mr-2">Giá từ: </label>
                <input type="number" class="form-control" name="min_price" style="width: 40px;height: 20px; margin-left:5px;margin-right:5px ;">
            
                <label for="max_price" class="mr-2">Đến: </label>
                <input type="number" class="form-control" name="max_price" style="width: 40px;height: 20px; margin:0 0 5px 5px;">
            <div class="col-auto">
                <br><button type="submit" class="btn btn-primary mb-2">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
            </div>
        </div>
    </form>


</div>

<div id="grid-selector">
       <div id="grid-menu">
       	   View:
           <ul>           	   
               <li class="largeGrid"><a href=""></a></li>
               <li class="smallGrid"><a class="active" href=""></a></li>
           </ul>
       </div>
       
       
</div>

@yield('frontend')

</div>

<footer class="credit">Author: shipra - Distributed By: <a title="Awesome web design code & scripts" href="https://www.codehim.com?source=demo-page" target="_blank">CodeHim</a></footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- partial -->
  <script  src="./js/script.js"></script>

</body>
</html>
