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
            {{ Form::open(['route'=>'publisher-search']) }}
    			<div class="input-group">
				  	<span class="input-group-btn">
                        <button class="btn btn-warning btn-lg" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> New App</button>
                    </span>
				  	<input type="search" name="search" class="form-control input-lg" placeholder="Search advertisement by title">
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit"><i class="fa fa-search"></i> Search</button>
                    </span>
				</div>
            {{ Form::close() }}
    		</div>
    	</div>
    </div>

    <br>
    <div class="container">
        <div class="row">    
            @if(Session::has('result'))
                <h1 class="text-center"> Search Results </h1>
                @foreach(Session::get('result') as $result)
                <div class="col-md-4">
                    <div class="w-bg">
                        <div class="media">
                            <a class="media-left" href="{{ URL::route('apps-detail',$result->app_id) }}">
                                <i class="fa fa-archive" style="font-size:50px"></i>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ URL::route('apps-detail',$result->app_id) }}">{{ $result->title }}</a>
                                </h4>
                                App Id : {{ $result->app_id }}
                            </div>
                        </div>
                        
                    </div>
                </div>    
                @endforeach
            @elseif(Session::has('no-result'))
                <h1 class="text-center"> Search Results </h1> 
                <h3>{{ Session::get('no-result') }}</h3>  
            @else               
                @foreach($data as $data)
                <div class="col-md-4">
                    <div class="w-bg">
                        <div class="media">
                            <a class="media-left" href="{{ URL::route('apps-detail',$data->app_id) }}">
                                <i class="fa fa-archive" style="font-size:50px"></i>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ URL::route('apps-detail',$data->app_id) }}">{{ $data->title }}</a>
                                </h4>
                                App Id: {{ $data->app_id }}
                            </div>
                        </div>
                    </div>   
                </div>    
                @endforeach
            @endif
            
        </div>
    </div>

@include('publishers.app-modal')
@stop