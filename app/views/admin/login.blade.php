{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('css/bootstrap.min.js') }}

{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/font-awesome.min.css') }} 
{{ HTML::style('css/master.css') }} 


	<div class="container">		
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<h2 style="padding:15px">Admin Login !</h2>

					<div class="row">
						<div class="col-md-11">
							@if(Session::has('global'))
								<div class="alert alert-danger" role ="alert">
									{{ Session::get('global') }}
								</div>
							@endif					
						</div>
					</div>

				{{ Form::open([ 'id'=>'adminForm', 'class'=>'form-horizontal', 'route'=>'admin-login' ]) }}
					<div class="form-group col-md-12 @if ($errors->has('username')) has-error @endif">
	                    <div class="inner-addon left-addon">
	                        <i class="fa fa-user"></i>
	                        <input type="text" id="username" name="username" class="form-control"  placeholder="name" />
	                      	@if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
	                    </div>  
					</div>
					<div class="form-group col-md-12 @if ($errors->has('password')) has-error @endif">
	                    <div class="inner-addon left-addon">
	                        <i class="fa fa-key"></i>
	                        <input type="password" id="password" name="password" class="form-control"  placeholder="Password" />
	 		                @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif	 		    
	    				</div>
	                </div>				
	                <div class="form-group col-md-12">                  
	                    <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>  
	                </div>
	            {{ Form::close() }}
	        </div>    
	    </div>  
    </div>        

	