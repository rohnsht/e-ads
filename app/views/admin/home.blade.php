@extends('layouts.admin')
@section('content')
	
	<div id ="stack" class="pull-left">		
		<ul class = "nav nav-pills nav-stacked">		
			<li><a href = "{{ URL::route('get-advertiser') }}">Advertisers</a></li>	
			<li class = "active"><a href = "{{ URL::route('admin-home') }}">Home</a></li>		
			<li><a href = "{{ URL::route('get-user') }}">Publishers</a></li>
		</ul>
	</div>

	<div class = "container" style = "margin-top:15px">
		<div class = "row">
			
				<div id = "myCarousel" class = "carousel slide" data-ride = "carousel">

					<ol class = "carousel-indicators">
						<li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
						<li data-target = "#myCarousel" data-slide-to = "1"></li>
						<li data-target = "#myCarousel" data-slide-to = "2"></li>
					</ol>

					<div class = "carousel-inner">

						<div class = "item active">
							<img src = "/image/admin/slide11.jpg" />
						</div>

						<div class = "item">
							<img src = "/image/admin/slide5.jpg" />
						</div>

						<div class = "item">
							<img src = "/image/admin/slide12.jpg" />
						</div>

					</div>
					<a class = "left carousel-control" href = "#myCarousel" data-slide = "prev">
						<span class = "glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class = "right carousel-control" href = "#myCarousel" data-slide = "next">
						<span class = "glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>						
		
		</div>
	</div>

@stop