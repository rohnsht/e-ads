@extends('layouts.main')

@section('content')
<br><br><br><br>
<div class="container">
		<div class="row">
			<div class="col-md-7 col-md-offset-2">

				<div class="panel panel-default">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Create a new password</h3>
				  	</div>
				  	<div class="panel-body">
				    	{{ Form::open(['class'=>'form-horizontal', 'url'=>'recover']) }}
				    		<input type="hidden" name="username" value="{{ $user->username }}" />
							<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
								<label for="password" class="col-md-6 col-md-offset-2">New password:</label>
								<div class="col-md-8 col-md-offset-2">
									<input type="password" id="password" name="password" class="form-control" placeholder="Enter your new password." />
									@if($errors->has('password'))
										<span class="help-block">{{ $errors->first('password') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('password-again') ? 'has-error' : '' }}">
								<label for="password-again" class="col-md-6 col-md-offset-2">Confirm password:</label>
								<div class="col-md-8 col-md-offset-2">
									<input type="password" id="password-again" name="password-again" class="form-control" placeholder="Enter the password again." />
									@if($errors->has('password-again'))
										<span class="help-block">{{ $errors->first('password-again') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-2">
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