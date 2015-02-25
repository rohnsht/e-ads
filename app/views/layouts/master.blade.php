<!DOCTYPE html>
<html>
<head>
	<title>E-ads</title>
	<meta name="viewport" content="width=device-width">

	<!-- linking css files -->
	@section('css')
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/font-awesome.min.css') }} 
		{{ HTML::style('css/master.css') }} 
    @show  
</head>

<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		<div class="navbar-inner">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	           
	            <a href="{{ URL::route('home') }}" class="navbar-brand">e-ads</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li><a id="sign-in" href="#"><i class="fa fa-sign-in"></i> LOGIN</a></li>
					<li><button id="sign-up" class="btn btn-sm btn-warning navbar-btn"><i class="fa fa-pencil-square-o"></i> SIGN UP</button></li>
				</ul>
			</div>
		</div>
		</div>	
	</div>

	@yield('content')
	@include('layouts.footer')
	<!-- linking javascript files -->
	@section('js')
		{{ HTML::script('js/jquery.min.js') }}
	    {{ HTML::script('js/bootstrap.min.js') }}
	 
    @show
</body>
</html>