@extends('layouts.default')

@section('navbar')
    <ul id="navs" class="nav navbar-nav">
        <li>
            <a href="{{ URL::route('publisher-dashboard') }}">
                <span class="glyphicon glyphicon-flash"></span> Dashboard
            </a>
        </li>
        <li class="active"><a href="{{ URL::route('publisher-documentation') }}">
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
		<div class="col-xs-6 col-sm-12">   
	        <div class="default-section w-bg">
				<h4><b>Getting Started</b></h4>
				</p>
					E-Ads supports showing Advertisements to your mobile, tablet, or PC website.
				</p>
				<br>
				<h4><b>Classic API</b></h4>
				</p>
					The Classic APIs make use of non-RESTful interfaces to provide a complete set of Advertisement solutions. Features includes Showing Advertisements in the websites.
				</p>
				<br>
				<h4><b>Create an E-Ads app</b></h4>
				</p>
				Navigate to the New Application, and log in if necessary. Click Create App to begin the application-creation process.

When you create a new app, E-Ads generates a set of keys for the application (the keys consist of a appId and appKey). See Manage your applications for details on creating and managing your PayPal applications.

Tip: See how the keys work by running the example in the next step—the example uses a set of dummy keys so you can easily make your first call by pasting the example as-is into a terminal window.	
				</p>
				<br>

	        </div>                     
	    </div>			
	</div>    
@stop