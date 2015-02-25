@extends('layouts.default')

@section('navbar')
    <ul id="navs" class="nav navbar-nav">
        <li>
            <a href="{{ URL::route('advertiser-dashboard') }}">
                <span class="glyphicon glyphicon-flash"></span> Dashboard
            </a>
        </li>
        <li class="active">
            <a href="{{ URL::route('advertiser-postAds') }}">
                <span class="glyphicon glyphicon-plus-sign"></span> Post Ads
            </a>
        </li>
        <li><a href="{{ URL::route('advertiser-profile', $data->username) }}">
            <span class="glyphicon glyphicon-edit"></span> Profile
        </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href=""><span class="badge">Views  &nbsp;{{ $data->views }}&nbsp;</span></a></li>
        <li><a href=""><span class="fa fa-bell"</span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> {{ Auth::user()->username }}
                <span class="fa fa-caret-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                <li class="dropdown-header">Welcome <br> {{ $data->username }}</li>
                <li class="divider"></li>
                <li><a href="#">Account</a></li>
                <li><a href="{{ URL::route('advertiser-logout') }}">Log out</a></li>
            </ul>
        </li>
    </ul>        
@stop

@section('content')
    <!-- <div id="menubar">
    	<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li><a href="{{ URL::route('advertiser-dashboard') }}">Dashboard</a></li>
                        <li class="active"><a href="{{ URL::route('advertiser-postAds') }}">Post Ads</a></li>
                        <li><a href="">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="row">

            <div class="col-xs-9 col-sm-3" id="sidebar" role="navigation">
                <div class="list-group">    
                    <a class="list-group-item list-group-header" href="{{ URL::route('category') }}">
                        Category
                        <span class="badge">14</span>
                    </a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Art & Entertainment') }}">Art & Entertainment</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Beauty & Personal Care') }}">Beauty & Personal Care</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Education') }}">Clothing</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Computers & Electronics</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Finance</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Food & Groceries</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Health</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Internet & Telecom</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Jobs & Education</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">News & Media</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Real Estate</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Sports & Fitness</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Travel $ Tourism</a>
                    <a class="list-group-item" href="{{ URL::route('category-type','Cosmetics') }}">Vehicles</a>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">   
                <div class="default-section w-bg">
                    <h3>Get Started</h3>
                    <p>
                        Fill up the form to post your advertisement in our site.
                        You can give us images of your advertisements in any of these three formats (.png/.gif/.jpg).
                        First you have to choose the criteria of your advertisement. Please choose the suitable criteria
                        listed below.
                    </p> 
                </div>
                          
                <div class="default-section panel panel-default">
                    <div class="panel-heading">
                        <h2 class="header-text">Fill up the form</h2>
                    </div>
                    <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2">
                    {{ Form::open(['class'=>'form-horizontal','files'=>'true', 'id'=>'myForm']) }}
                        <div class="form-group">
                            <label for="title"class="col-sm-12">Title:</label>
                            <div class="col-md-12" id="title-group">
                                <input type="text" id="title" name="title" class="form-control"/>
                                <span class="error" id="title-error">
                                    @if($errors->has('title'))
                                        {{ $errors->first('title') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="alert alert-warning">
                            <p><i class="fa fa-exclamation-circle"></i> Please choose your category 
                            wisely and help publishers to get valid advertisement in their website. </p>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-sm-12">Category:</label>
                            <div class="col-md-12">
                                <select id="category" name="category" class="form-control">
                                    <option value="Art & Entertainment">Art & Entertainment</option>
                                    <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Computers & Electronics">Computers & Electronics</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Food & Groceries">Food & Groceries</option>
                                    <option value="Health">Health</option>
                                    <option value="Internet & Telecom">Internet & Telecom</option>
                                    <option value="Jobs & Education">Jobs & Education</option>
                                    <option value="News & Media">News & Media</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Sports & Fitness">Sports & Fitness</option>
                                    <option value="Travel & Tourism">Travel & Tourism</option>
                                    <option value="Vehicles">Vehicles</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file"class="col-sm-12">Advertisement:</label>
                            <div class="col-md-12" id="file-group">
                                <input type="file" id="file" name="file"/>
                                <span class="error" id="file-error">
                                    @if($errors->has('file'))
                                        {{ $errors->first('file') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active"  role="progressbar"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                0% Complete
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" id="submit" class="btn btn-info btn-lg btn-block">
                                    <i class="fa fa-upload"></i> Upload
                                </button>
                            </div>
                             <div class="col-md-6">
                                <button type="reset" class="btn btn-default btn-lg btn-block">Clear</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                    </div>
                    </div>
                </div>
              
            </div>
            
        </div>
    </div>
        
@stop

@section('js')
    @parent
    {{ HTML::script('js/upload.js') }}
@stop