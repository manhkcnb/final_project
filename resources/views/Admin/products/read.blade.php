@extends("admin.layout")
@section("admin-view")

<form method="post" action="{{url('backend/products/searchKey')}}">
    @csrf
    <div class="col-md-12" style="display:flex; margin-bottom: 10px;">
        <input type="name" class="form-control" name="key" placeholder="Nhập sản phẩm cần tìm kiếm">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>
</form>


<form method="post" action="{{url('backend/products/deleteItems')}}">
    <div class="col-md-12">
    <div style="margin-bottom: 5px;" style="display: flex;">
        <a href="{{ url('backend/products/create') }}" class="btn btn-primary">Create</a>
        <a href="{{ url('backend/products/allSoftDeleted') }}" class="btn btn-primary">AllSoftDeleted</a>
        <input type="submit" value="Delete selected" class="btn btn-danger" >
       
       
        <label for="soluong">Show</label>
        <select name="soluong" class="soluong">
            @if(isset($soluong))
            <option value="$soluong">{{$soluong}}</option>
            @else
            <option value="50" selected>50</option>
            @endif
            <option value="1">1</option>
            <option value="5">5</option>
            <option value="10">10</option>
           
            <option value="100">100</option>
        </select>
        <label for="soluong">Items</label>
        <script>
        $(document).ready(function() {
            $('select.soluong').on('change', function() {
                var selectedSoluong = $('select.soluong ').val();
                 console.log(selectedSoluong);
                // Gửi yêu cầu AJAX
                $.ajax({
                    url: "{{ url('soluongItems') }}",
                    method: 'GET',
                    data: { soluong: selectedSoluong },
                    success: function(data) {
                        console.log("ss");
                        // Cập nhật dữ liệu và phân trang
                        $('body').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        </script>
    </div>
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
                        
                       {{$row->category_name}}
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
                @if(isset($soluong))
                {{ $data->appends(['soluong' => $soluong])->links() }}
                @else 
                    {{ $data->render() }}
                @endif
            </div>

           
            </div>
        

    </div>  
</div>
</form>
@endsection