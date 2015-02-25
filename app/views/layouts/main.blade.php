<!DOCTYPE html>
<html>
<head>
	<title>Adsense</title>
	<meta name="viewport" content="width=device-width">
	
	<!-- linking css files -->
	@section('css')
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/font-awesome.min.css') }} 
		{{ HTML::style('css/main.css') }} 
    @show  
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
		<div class="navbar-inner">
			<div class="navbar-header">
	            <a class="navbar-brand" href="{{ URL::route('home') }}">E-ads</a>
			</div>
		</div>
		</div>	
	</div>

	@yield('content')
	<!-- linking javascript files -->
	@section('js')
		{{ HTML::script('js/jquery.min.js') }}
	    {{ HTML::script('js/bootstrap.min.js') }}
    @show
</body>
</html>