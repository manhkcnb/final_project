@extends("admin.layout")
@section("admin-view")
	<div class="col-md-12">  
	    <div class="panel panel-primary">
	        <div class="panel-heading">Add edit</div>
    
	        <div class="panel-body">
	        	<!-- if you want to upload files, you must have the enctype="multipart/form-data" attribute -->
	        <form method="post" enctype="multipart/form-data" action="{{ $action }}">
	        	@csrf
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Name</div>
	                <div class="col-md-10">
	                    <input type="text" required value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" required>
	                </div>
	            </div>
	            <!-- end rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Photo</div>
	                <div class="col-md-10">
	                    <input type="text" required value="{{ isset($record->photo)?$record->photo:'' }}" name="photo" class="form-control" required>
	                </div>
	            </div>
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Price</div>
	                <div class="col-md-10">
	                    <input type="text" required value="{{ isset($record->price)?$record->price:'' }}" name="price" class="form-control" required>
	                </div>
	            </div>
	            <!-- end rows -->
	            <!-- rows -->
	           
	            <!-- end rows -->
	            <!-- rows -->
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2">Category</div>
	                <div class="col-md-10">
	         
	                    <select class="form-control" name="category_id" style="width:250px;">
	                    @php

	                    	$categories = DB::select("select * from category   order by id desc");
	                    @endphp

	                    @foreach($categories as $row)	                    
	                    	<option @if(isset($record->category_id)&&$record->category_id==$row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>	
	                    	@php
	                    		$subCategories = DB::table("products")->where("category_id","=",$row->id)->orderBy("id","desc")->get();
	                    	@endphp                   
	                    	 	
	                    @endforeach
	                    </select>
	                </div>
	            </div>
	            
	            <div class="row" style="margin-top:5px;">
	                <div class="col-md-2"></div>
	                <div class="col-md-10">
	                    <input type="submit" value="Process" class="btn btn-primary">
	                </div>
	            </div>
	            <!-- end rows -->
	        </form>
	        </div>
	    </div>
	</div>
@endsection