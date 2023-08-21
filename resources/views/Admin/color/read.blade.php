@extends("admin.layout")
@section("admin-view")
    <div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="{{ url('backend/color/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    
                    <th>Name</th>
                    <th style="width:80px;">Color</th>
                    <th style="width:100px;"></th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>
                    	{{ $row->name }}
                    </td>
                    <td>
                        <div style="background:{{$row->code}};border: 1px solid grey;width: 50px;height: 50px;"></div>
                    </td>
                    
                    <td style="text-align:center;">
                        <a href="{{ url('backend/color/update/'.$row->id) }}">Edit</a>&nbsp;
                        <a href="{{ url('backend/color/delete/'.$row->id) }}" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            {{ $data->render() }}
        </div>
    </div>
</div>
@endsection