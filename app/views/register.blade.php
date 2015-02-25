<div id="register">
	<div class="container">
		<div class="row">	
			<div class="col-md-offset-4 col-md-4">
				<div class="row">
					<div class="col-md-11">
						<h1>Sign up here</h1>
						<a href="{{ URL::to('login/fb') }}" class="btn btn-custom btn-facebook btn-lg btn-block">
							<span class="fa fa-facebook"></span>&nbsp;&nbsp;
							Sign up with facebook
						</a>
						<div class="hr">
							<div class="inner">
								or
							</div>
						</div>
					</div>
				</div>
				{{ Form::open([ 'id'=>'registerForm', 'class'=>'form-horizontal']) }}
					<div id="username-group" class="form-group">
						<div class="col-md-11">
		                    <div class="inner-addon left-addon">
		                        <i class="fa fa-user"></i>
		                        <input type="text" id="username" name="username" class="form-control"  placeholder="Username" />
		                        <span class="error" id="username-error"></span>
		                    </div> 
	                    </div> 
					</div>
					<div id="password-group" class="form-group">
						<div class="col-md-11">
	                    	<div class="inner-addon left-addon">
	                        	<i class="fa fa-key"></i>
	                        	<input type="password" id="password" name="password" class="form-control"  placeholder="Password" />
	                        	<span class="error" id="password-error"></span>			                        
	    				    </div>
	    				</div>
	                </div>
	                <div  id="password-again-group" class="form-group">
	                	<div class="col-md-11">
	                    	<div class="inner-addon left-addon">
		                        <i class="fa fa-key"></i>
		                        <input type="password" id="password-again" name="password-again" class="form-control"  placeholder="Re-type password" />
		                        <span class="error" id="password-again-error"></span>
		                    </div>
	                    </div>
	                </div>
					<div id="email-group" class="form-group">
						<div class="col-md-11">
	                    	<div class="inner-addon left-addon">
		                        <i class="fa fa-envelope"></i>
		                        <input type="Email" id="email" name="email" class="form-control"  placeholder="Email" />
		                        <span class="error" id="email-error"></span>
		                    </div>    
	                    </div>
					</div>
	                <div id="account-group" class="form-group">
	                	<div class="col-md-11">
		                	<center>
			                    <label class="col-md-12">Account type:</label>
	                            <label class="radio-inline">
	                                <input type="radio" id="account" name="account" value="publisher" /> Publisher
	                            </label>
	                            <label class="radio-inline">
	                                <input type="radio" id="account" name="account" value="advertiser"/> Advertiser
	                            </label>

	                     	</center>
	                     	<span class="error" id="account-error"></span>
                     	</div>
	                </div>
					<div class="form-group">
						<div class="col-md-11">                  
	                    	<button type="submit" id="signup-btn" class="btn btn-custom btn-success btn-lg btn-block">
	                    		Create Account
	                    	</button>  
	                	</div>
	                </div>
	                <div class="form-group">
	                	<div class="col-md-11">
	                    	<p>By registering you confirm that you accept the <a href="#">Terms & conditons</a> and <a href="#">Privacy Policy</a></p>
	                	</div>
	                </div>
	                
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>	
