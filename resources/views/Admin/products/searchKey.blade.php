@extends("admin.layout")
@section("admin-view")
<form method="post" action="{{url('backend/products/searchKey')}}">
    <div class="col-md-12" style="display:flex; margin-bottom: 10px;">
        @csrf
        <input type="key" class="form-control" id="floatingInput" placeholder="Nhập sản phẩm cần tìm kiếm">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>
</form>


<form method="post" action="{{url('backend/products/deleteItems')}}">
    <div class="col-md-12">
        <h2>Tìm kiếm :{{$key}}</h2>
        <div class="panel panel-primary">
          
                    <div class="panel-heading">List</div>
                    <div class="panel-body">
                   
                        @csrf
                        <table class="table table-bordered table-hover">
                       
                            <tr><th style="width:30px;"></th>
                                <th style="width:100px;">Photo</th>
                                <th>Name</th>
                                <th style="width:100px;">Category</th>
                                <th style="width:100px;">Price</th>
                                <th style="width:100px;"></th>
                                <th style="width:100px;"></th>
                            </tr>
                            @foreach($data as $row)
                            <tr>
                                
                                 <td style="width:30px;"><input type="checkbox" id="select-all" value="{{$row->id}}"  name="items[]"></td>
                                <td>
                                    <img src="{{$row->photo}} " style="width:100px;">
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    <!-- gọi hàm getCategoryName trong class App\MyCustomClass\Products -->
                                    {{  App\Models\Admin\Product::getCategoryName($row->category_id) }}
                                </td>
                                <td>{{ number_format($row->price) }}</td>
                                <td style="text-align:center;"> <a href="{{ url('backend/detail/'.$row->id) }}">Details</a> </td>
                                <td style="text-align:center;">
                                    <a href="{{ url('backend/products/update/'.$row->id) }}">Edit</a>&nbsp;
                                    <a href="{{ url('backend/products/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                       
                        </table>
              
               
                        <style type="text/css">
                            .pagination{padding:0px; margin:0px;}
                        </style>
                        <div class="pagination">
                           {{ $data->render() }}
                        </div>

               
                    </div>
            

        </div>  
    </div>
</form>
@endsection