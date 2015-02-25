<div id="login">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="row">
					<div class="col-md-11">
						<h1>Get Started</h1>
						<a href="{{ URL::to('login/fb') }}" class="btn btn-custom btn-facebook btn-lg btn-block">
							<span class="fa fa-facebook"></span>&nbsp;&nbsp;
							Sign in with facebook
						</a>
						<div class="hr">
							<div class="inner">
								or
							</div>
						</div>
					</div>
				</div>
				{{ Form::open(['id'=>'loginForm', 'class'=>'form-horizontal']) }}
					<div class="form-group">
						<div class="col-md-11">
	                        <div id ="username-group" class="inner-addon left-addon">
	                            <i class="fa fa-user"></i>
	                            <input type="text" id="username" name="username" class="form-control"  placeholder="Username" />
	                            <span id ="username-error"></span>
	                        </div>  
                    	</div>
					</div>
					<div class="form-group">
						<div class="col-md-11">
	                        <div id="password-group" class="inner-addon left-addon">
	                            <i class="fa fa-key"></i>
	                            <input type="password" id="password" name="password" class="form-control"  placeholder="password" />
	                            <span id ="password-error"></span>
	 					    </div>  
 						</div>
                    </div>
                    <div class="form-group">
						<div class="col-md-11">
	                        <label class="checkbox-inline">
                        		<input type="checkbox" id="remember" name="remember" value="remember"/>Stay signed in
                        	</label>   
 						</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-11">                  
                        	<button type="submit" class="btn btn-custom btn-warning btn-lg btn-block" name="Submit">Login</button>	 
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-11">
                    		<p><a href="{{ URL::route('forgot-password') }}">Forgot password?</a></p>
                    	</div>                    	
                    </div>
                    <div class="form-group">
                    	<div class="col-md-11">
                        	<p>Don't have an account <a href="{{ URL::to('register') }}">Sign up now!</a></p>
                    	</div>
                    </div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
	