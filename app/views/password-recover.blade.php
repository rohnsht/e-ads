@extends('layouts.main')

@section('content')
	<br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-md-offset-2">

				<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Reset your password</h3>
				  	</div>
				  	<div class="panel-body">
				  	@if(Session::has('message'))
				  		{{ Session::get('message') }}
				  	@elseif(!Session::has('message'))
				    	{{ Form::open(['class'=>'form-horizontal']) }}
							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
								<label for="email" class="col-md-3 control-label">E-mail:</label>
								<div class="col-md-8">
									<input type="email" id="email" name="email" class="form-control" placeholder="Enter your email." />
									@if($errors->has('email'))
										<span class="help-block">{{ $errors->first('email') }}</span>
									@endif
								</div>
							</div>				
							<div class="form-group">
								<div class="col-md-8 col-md-offset-3">
									<button type="submit" class="btn btn-success">Send</button>		
									<a href="{{ URL::route('home') }}" class="btn btn-default">Cancel</a>					
								</div>					
							</div>
						{{ Form::close() }}
					@endif 
				</div>
				
			</div>
		</div>
	</div>

@stop

