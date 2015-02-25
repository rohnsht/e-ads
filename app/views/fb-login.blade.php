@extends('layouts.main')

@section('content')
	<?php 
		$username = $fbData['first_name'].$fbData['last_name'] ;
		$username = strtolower($username).rand(10,99);	
	?>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Welcome {{ $fbData['first_name'] }}! Complete your account details. </h3>
				  	</div>
				  	<div class="panel-body">
				  		<img class="col-sm-4" src="https://graph.facebook.com/{{ $fbData['id'] }}/picture?type=large" height="200px" width="200px"/>
				    	{{ Form::open(['class'=>'form-horizontal col-md-8','url'=>'login/fb']) }}
				    		<div class="form-group">
				    			<label class="col-md-8">Email:</label>
				    			<div class="col-md-8">
				    				<span>{{ $fbData['email'] }}</span>
				    			</div>	
				    		</div>

				    		<input type="hidden" name="fb_user" value="{{ $fbData['id'] }}" />
				    		<input type="hidden" name="email" value="{{ $fbData['email'] }}" />

							<div class="form-group">
								<label for="username" class="col-md-8">Username:</label>
								<div class="col-md-8">
									<input type="username" id="username" name="username" class="form-control" value ="<?php echo $username; ?>" />
									@if($errors->has('username'))
										<span class="help-block">{{ $errors->first('username') }}</span>
									@endif
								</div>
							</div>
							<div id="account-group" class="form-group">			                	
			                    <label class="col-md-8">Account type:</label>
			                    <div class="col-md-8">
		                            <label class="radio-inline">
		                                <input type="radio" id="account" name="account" value="publisher" /> Publisher
		                            </label>
		                            <label class="radio-inline">
		                                <input type="radio" id="account" name="account" value="advertiser"/> Advertiser
		                            </label>
			                     	@if($errors->has('account'))
										<span class="help-block">{{ $errors->first('account') }}</span>
									@endif
			                    </div>	
	                		</div>
							<div class="form-group">
								<div class="col-md-8">
									<button type="submit" class="btn btn-success">Send</button>		
									<a href="{{ URL::route('home') }}" class="btn btn-default">Cancel</a>					
								</div>					
							</div>
						{{ Form::close() }}
				
				  	</div>
				</div>	
			</div>
		</div>
	</div>
@stop