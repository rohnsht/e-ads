@extends('layouts.default')

@section('navbar')
    <ul id="navs" class="nav navbar-nav">
        <li>
            <a href="{{ URL::route('publisher-dashboard') }}">
                <span class="glyphicon glyphicon-flash"></span> Dashboard
            </a>
        </li>
        <li><a href="{{ URL::route('publisher-documentation') }}">
            <span class="glyphicon glyphicon-book"></span> Documentation
        </a></li>
        <li><a href="{{ URL::route('publisher-profile', $user->username) }}">
            <span class="glyphicon glyphicon-edit"></span> Profile
        </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href=""><span class="badge">Views  &nbsp;{{ $user->views }}&nbsp;</span></a></li>
        <li><a href=""><span class="fa fa-bell"</span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> {{ Auth::user()->username }}
                <span class="fa fa-caret-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li class="dropdown-header">Welcome <br> {{ $user->username }}</li>
                <li class="divider"></li>
                <li><a href="#">Account</a></li>
                <li><a href="{{ URL::route('publisher-logout') }}">Log out</a></li>
            </ul>
        </li>
    </ul>        
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
				 	<div class="panel-heading">
				   		<h3 class="panel-title">Dashboard</h3>
				  	</div>
				  	<div class="panel-body">
				  		<div class="row">
					    	<div class="col-md-2">
					    		<span class="fa fa-archive" style="font-size:100px"></span>
					    	</div>
					    	<div class="col-md-7">
					    		<h3>{{ $apps->title }}</h3>
					    		App id   : {{ $apps->app_id }}<br>
					    		App key  : {{ $apps->app_key }}<br>
					    		Category : {{ $apps->category }}
					    	</div>
					    	<div class="col-md-3">
					    		<br>
					    		<p>Do you wish to delete this app?</p>
					    		{{ Form::open(['method'=>'DELETE','route'=>['apps-delete',$apps->id]]) }}
					    			<button type="submit" class="btn btn-danger">Delete</button>
					    		{{ Form::close() }}
					    	</div>
					  	</div>
				  	</div>
				</div>
			</div>
		</div>	
	</div>

	<div class="container">	
		<div class="w-bg">
			<div class="row">
				<div class="col-md-9">
					<h2>Get Started</h2>
					<p>To publish our advertisements in your website, you need to <a href="{{ URL::asset('/sdk/e-ads.zip') }}">download</a>
					 our sdk by clicking the Download button. Then read out the Documentation and follow the instructions.</p>
				</div>
				<div class="col-md-3">
			
					<br><br>
					<a href="{{ URL::asset('/sdk/e-ads.zip') }}" class="btn btn-default btn-lg btn-block">
						<i class="fa fa-download"></i> Download
					</a>
			
				</div>
			</div>
		</div>
	</div>
@stop