@extends('layouts.master')

@section('css')
	@parent
	<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.3.15/slick.css"/> -->
@stop

@section('content')	
	<div id="ajax">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			
	      	<div class="container">
	        	<div class="carousel-caption-left">
	          		<h4>Lets make advertisement easier and available to everyone.</h4><br>
	          		<p><a class="btn btn-lg btn-default btn-outline" id="signup" href="#" role="button">SIGN UP</a></p>
	        	</div>        	
	        </div>
	      	<div class="carousel-inner">
	        	<div class="item active item-first">
	          		<div class="container">	
			        	<div class="carousel-caption-right">
			          		<p>Want to Advertise!!</p>			          
			        	</div>        	
		        	</div>	
	        	</div>
		         
		        <div class="item item-second">
		          	<div class="container">
			        	<div class="carousel-caption-right">	
			          		<p>Boost Your Audience!</p>	          	
			        	</div>        	
			        </div>
				</div>   
			</div>
		</div>
		
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">	
				<h2>How it works?</h2>
				<p>"E-Ads" is a free, simple way to earn money by displaying the targeted advertisements next to the Online Contents.
					We provide a platform to maintain, categorized advertisements posted by advertiser. Advertiser can post their advertisements
					into our website and publisher
	          		can publish the advertisements into their websites.</p>	  
			</div>
		</div>
	</div>

	<div id="grid">
		<div class="container">
			<div class="row">
				<h1>Advertisements in our site</h1>
				@foreach($randAds as $data)
					<div class="col-md-3">
						<div class="thumbnail">
	                        <img src="{{ e($data->ads) }}"/>
							<div class="caption">
								<p>{{ e($data->title) }}</p>
							</div>
						</div>
					</div>	
				@endforeach
			</div>
		</div>
 	</div>

 	<!-- <div id="popularSlide" class="container">
 		<div class="row">
 			<div class="col-md-12">
 				<h3>Popular Advertisements</h3>
 				<div class="popularSlide">
 					@foreach($popAds as $data)	
						<div>
	                        <div class="img-thumbnail">
	                        	<img src="{{ e($data->ads) }}" height="150px" width="200px" />
	                        </div>		
						</div>		
					@endforeach
 				</div>
 			</div> 
 		</div>
 	</div> -->

 	
 	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					{{ Session::get('global') }}
				</div>
			</div>
		</div>
	</div>
	
@stop

@section('js')
	@parent
	{{ HTML::script('js/login.js') }}
	{{ HTML::script('js/register.js') }}
	<!-- {{ HTML::script('//cdn.jsdelivr.net/jquery.slick/1.3.15/slick.min.js') }} -->
	@if(Session::has('global'))
	<script>
		$('#myModal').modal('show');
	</script>
	@endif
	<script>
		$(document).ready(function(){
			$('.popularSlide').slick({
				dots: true,
			  	infinite: false,
			  	autoplay: true,
			  	autoplaySpeed: 5000,
			  	speed: 300,
			  	slidesToShow: 5,
			  	slidesToScroll: 2,
			  	responsive: [
				    {
				      	breakpoint: 1024,
				      	settings: {
				        slidesToShow: 3,
				        slidesToScroll: 3,
				        infinite: true,
				        dots: true
				     	}
				    },
				    {
				      	breakpoint: 600,
				      	settings: {
				        	slidesToShow: 2,
				        	slidesToScroll: 2
				      	}
				    },
				    {
				      	breakpoint: 480,
				      	settings: {
				       		slidesToShow: 1,
				       		slidesToScroll: 1
				      	}
				    }
			  	]
			});
		});	
	</script>
@stop 