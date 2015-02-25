<!Doctype html>
<html>
<head>
	<title>E-ads</title>
	<meta name="viewport" content="width=device-width">

	<!-- linking css files -->
	@section('css')
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/font-awesome.min.css') }} 
		{{ HTML::style('css/default.css') }} 
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
		           
		            <a class="navbar-brand" href="{{ URL::route('home') }}">e-ads</a>
				</div>
				<div class="navbar-collapse collapse">
					@yield('navbar')
				</div>
			</div>	
		</div>
	</div>

	@yield('content')

	@include('layouts.footer')

	@section('js')
		<!-- linking javascript files -->
		{{ HTML::script('js/jquery.min.js') }}
	    {{ HTML::script('js/bootstrap.min.js') }}
	    <script>
	    	/*$(document).ready(function(){*/
				$('.dropdown').hover(
				function(){
					$(".dropdown-toggle").css({'color':'#fff','background-color':'#000'});
					$('.dropdown-menu').toggle();
				},function(){
					$(".dropdown-toggle").css({'color':'#e5e5e5','background-color':'rgb(95,95,95)'});
					$('.dropdown-menu').toggle();
				});
			/*});*/
		</script>
    @show
</body>
</html>