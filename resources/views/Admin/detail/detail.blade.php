@extends("admin.layout")
@section("admin-view")
<main role="main">
        <div class="container mt-4">
            <div class="card">
                <div class="container-fliud">
                    <form  id="frmsanphamchitiet" method="post"
                        action="{{url('backend/detailPost')}}">
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

                                
                                <h4 class="product-description">
                                    @php
                                    $category=\App\Http\Controllers\Frontend\indexController::readCategory($data->category_id);
                                    @endphp
                                    Hãng: {{$category->name}}
                                </h4>
                                
                                <h4 class="price">Giá hiện tại: <span>{{number_format($data->price)}} vnđ</span></h4>
                               
                                 
                                <h5 class="sizes"> Size:
                                	
                                	<select name="size">
                                		@php
                                		$sizes=\App\Http\Controllers\Frontend\indexController::getSize();
                                		@endphp
                                		@foreach($sizes as $row)
                                		<option  @if(isset($size)&& $row->name==$size) selected @endif  value="{{$row->name}}" > {{$row->name}}</option>
                                		@endforeach
                                	</select>
                                	
                                    
                                </h5>
                                
                                <h5 class="colors" >Color:
                                	<select name="color">
                                		@php
                                		$size=\App\Http\Controllers\Frontend\indexController::getColor();
                                		@endphp
                                		@foreach($size as $row)
                                		<option @if(isset($color)&& $row->name==$color) selected @endif value="{{$row->name}}"> {{$row->name}}</option>
                                		@endforeach
                                	</select>
                                    
                                </h5>
                                

                                <div class="form-group">
                                    <label for="soluong">Số lượng :</label>
                                    <input type="number" class="form-control" id="soluong" name="quantity" value="{{isset($quantity)?$quantity:''}}" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="button" value="Cập nhâp">
                                </div>
                            </div>
                            <script>
								$(document).ready(function() {
								    $('.sizes select, .colors select').on('change', function() {
								        var selectedSize = $('.sizes select').val();
								        var selectedColor = $('.colors select').val();
                                          
								        
								        // Gửi yêu cầu AJAX
								        $.ajax({
								            url: "{{url('get-quantity')}}", // Điều chỉnh đường dẫn đến route xử lý yêu cầu AJAX
								            method: 'GET',
								            data: { size: selectedSize, color: selectedColor },
								            success: function(data) {
								                $('#soluong').val(data.quantity); // Đặt giá trị số lượng trong input
								            },
								            error: function(xhr, status, error) {
								                console.error(error);
								            }
								        });
								    });
                                    

								});
							</script>


                        </div>
                    </form>
                    

                </div>
            </div>

            
        </div>
        <!-- End block content -->
    </main>
@endsection