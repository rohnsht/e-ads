@extends('layouts.admin')

@section('content')

	<div id ="stack" class="pull-left">   
        <ul class = "nav nav-pills nav-stacked">    
          <li class="active"><a href = "{{ URL::route('get-advertiser') }}">Advertisers</a></li> 
          <li><a href = "{{ URL::route('admin-home') }}">Home</a></li>   
          <li><a href = "{{ URL::route('get-user') }}">Publishers</a></li>
        </ul>
    </div>

	<div class ="container" style = "padding-top:10px">
	@foreach($data as $image)
		<div class = "row">
			<div class="col-md-3 col-md-offset-1">
                <a href = "#">
					<img src = "/{{e($image->ads)}}" alt = "{{ e($image->title) }}" height="120px" width="160px" />		
				</a>
			</div>
			<div class="col-md-9 col-md-offset-1">
				<form class ="form-horizontal" method = "POST" action ="{{ URL::route('change-category') }}">	
					<input type="hidden" name="id" value="{{ $image->id }}" />					
					<div class="form-group">	
						<label class="col-sm-2">Title:</label>
						<div class="col-sm-10">
							<p>{{ e($image->title) }}</p>
						</div>	

	                	<label class="col-sm-2">Category:</label>
	            		<div class="col-sm-10">
							<p>{{ e($image->category) }}</p>
						</div> 

	                	<label for="category" class="col-sm-2">Change Category:</label>
	            		<div class="col-md-4">
	            			<div class="input-group">
				 					<span class="input-group-btn">
									<button class="btn btn-primary" type="submit">Change</button>
						 			</span>  						 		
	                			<select id="category" name="category" class="form-control">
	                    			<option value="Clothing">Clothing</option>
	                    			<option value="Cosmetics">Cosmetics</option>
	                    			<option value="Education">Education</option>
	                   				<option value="Entertainment">Entertainment</option>
	                    			<option value="Internet">Internet</option>
	                			</select>
	            			</div>
	            		</div> 		               			
               		</div>
               	</form>  	
			</div>	
		</div>
		<br>
		@endforeach
	</div>
@stop	 	
