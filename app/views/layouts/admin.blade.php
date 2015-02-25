<!Doctype html>
<html>
<head><title>Admin page</title>

	@section('css')
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/font-awesome.min.css') }} 	
		{{ HTML::style('css/adminCustom.css') }} 
    @show  
</head>
<body>

<div class = "navbar navbar-default navbar-fixed-top">	
	<div class = "container">
		<div class = "navbar-inner">
			<div class = "navbar-header">
				<button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = ".navbar-collapse">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
           		</button>
				<a href="{{ URL::route('home') }}" class="navbar-brand">e-ads</a>
           	</div>	
			<div class = "navbar-collapse collapse">
				<ul class = "nav navbar-nav navbar-right">
					<li class = "dropdown">
						<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown">
						<i class = "fa fa-user"></i> {{ Auth::user()->username }}
						<span class = "fa fa-caret-down"></span>
						</a>
						<ul class = "dropdown-menu dropdown-menu-right" role = "menu">
							<li class = "dropdown-header">Welcome {{ Auth::user()->username }}</li>
							<li class = "divider"></li>
							<li><a href = "{{ URL::route('admin-logout') }}">Log out</a></li>
						</ul>
					</li>		
				</ul> 
			</div>					
		</div>	
	</div>		
</div>	

@yield('content')

@section('js')
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	<script>
		$(document).ready(function(){
			$('.dropdown').hover(
				function(){
				$(".dropdown-toggle").css('color','#fff');
				$('.dropdown-menu').toggle();
				},function(){
				$(".dropdown-toggle").css('color','#ccc');
				$('.dropdown-menu').toggle();
			});
		});
	</script>	
@show

</body>
</html>