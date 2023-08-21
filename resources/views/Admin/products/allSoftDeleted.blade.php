@extends("admin.layout")
@section("admin-view")




<form method="post" action="{{url('backend/products/deleteItems')}}">
    <div class="col-md-12">
    <div style="margin-bottom: 5px;" style="display: flex;">
         <a href="{{ url('backend/products') }}" class="btn btn-primary">Product</a>
      
      
       
       
       
    </div>
    <div class="panel panel-primary">
      
                <div class="panel-heading">List</div>
                <div class="panel-body">
           
                @csrf
                 <table class="table table-bordered table-hover">
               
              
                    <th style="width:100px;">Photo</th>
                    <th>Name</th>
                    <th style="width:100px;">Category</th>
                    <th style="width:100px;">Price</th>
                    <th style="width:100px;"></th>
                    <th style="width:150px;"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    
                     
                    <td>
                        <img src="{{$row->photo}} " style="width:100px;">
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>
                       
                        {{  App\Models\Admin\Product::getCategoryName($row->category_id) }}
                    </td>
                    <td>{{ number_format($row->price) }}</td>
                    <td style="text-align:center;"> <a href="{{ url('backend/detail/'.$row->id) }}">Details</a> </td>
                    <td style="text-align:center;">
                        <a href="{{ url('backend/products/restore/'.$row->id) }}">Restore</a>&nbsp;
                        <a href="{{ url('backend/products/deletes/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                @endforeach
               
            </table>
          
           
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <div class="pagination">
               
            </div>

           
            </div>
        

    </div>  
</div>
</form>
@endsection