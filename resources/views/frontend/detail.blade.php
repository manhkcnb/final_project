<!DOCTYPE html>
<html lang="vi" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/detail.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>

<body>
    <!-- header -->
    
    @include("frontend.header")
    <!-- end header -->

    <main role="main">
       
        <div class="container mt-4">
            <div id="thongbao" class="alert alert-danger d-none face" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="card">
                <div class="container-fliud">
                    <form  id="frmsanphamchitiet" method="post"
                        action="{{url('detailPost')}}">
                        @csrf
                        <input type="hidden" name="name" id="sp_ten" value="{{$data->name}}">
                        <input type="hidden" name="price" id="sp_gia" value="{{$data->price}}">
                        <input type="hidden" name="photo" id="hinhdaidien" value="{{$data->photo}}">

                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <img src="{{$data->photo}}" style="width: 400px;">
                                
                            </div>
                            <div class="details col-md-6">
                                <h3 class="product-title">{{$data->name}}</h3>
                                
                                <p class="product-description">
                                     Category :{{$data->category->name}}
                                </p>
                                
                                <h4 class="price">Price: <span>{{number_format($data->price)}} vnđ</span></h4>
                                @php
                                    $product_if=$data->product_if;
                                    $printedSizes = [];
                                    $printColor = [];
                                @endphp
                                <h5 class="sizes">sizes:
                                    @foreach($product_if as $key)
                            
                                    @if (!in_array($key->size->name, $printedSizes))
                                        
                                        <input type="radio" id="size_{{$key->size->name}}" class="size-button" name="size" value="{{$key->size->name}}">
                                        <label class="size-label" for="size_{{$key->size->name}}">{{$key->size->name}}</label>
                                            @php
                                                $printedSizes[] = $key->size->name;
                                            @endphp
                                    @endif
                                    @endforeach
                                </h5>
                                
                                <h6 class="colors" >colors:
                                    @foreach($product_if as $key)
                                
                                    @if(!in_array($key->color->code,$printColor))
                                        <label style="background:{{$key->color->code}};border: 0.1px solid grey; display: inline-block; padding: 10px; ">
                                                <input type="radio" class="size-button" name="color" value="{{$key->color->name}}">
                                        </label>
                                        
                                        @php
                                            $printColor[] = $key->color->code;
                                        @endphp
                                    @endif
                                    @endforeach
                                </h6>
                                <script>
                                    const sizeButtons = document.querySelectorAll('.size-button');
                                    const colorButtons = document.querySelectorAll('.color-button');

                                    sizeButtons.forEach(button => {
                                        button.addEventListener('click', () => {
                                            sizeButtons.forEach(btn => btn.classList.remove('selected'));
                                            button.classList.add('selected');

                                            const selectedSize = button.value;
                                          
                                        });
                                    });

                                    colorButtons.forEach(button => {
                                        button.addEventListener('click', () => {
                                            colorButtons.forEach(btn => btn.classList.remove('selected'));
                                            button.classList.add('selected');

                                            const selectedColor = button.value;
                                            
                                        });
                                    });
                                </script>

                                <div class="form-group">
                                    <label for="soluong">Order quantity:</label>
                                    <input type="number" class="form-control" id="soluong" name="quantity">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="button" value="Add cart">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <
        </div>
        <!-- End block content -->
    </main>

    <!-- footer -->
   
    <!-- end footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popperjs/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom script - Các file js do mình tự viết -->
    <script src="../assets/js/app.js"></script>

</body>

</html>