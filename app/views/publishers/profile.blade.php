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
        <li class="active"><a href="{{ URL::route('publisher-profile', $user->username) }}">
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
    <!-- <div id="menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li><a href="{{ URL::route('advertiser-dashboard') }}">Dashboard</a></li>
                        <li><a href="">Documentation</a></li>
                        <li class="active"><a href="{{ URL::route('advertiser-profile', Auth::user()->username) }}">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">    
                <div class="default-section panel panel-default">
                    <div class="panel-heading">
                        <h3 class ="panel-title"><b>Your Account</b></h3>
                    </div>
                    <div class="panel-body">                      
                        <p>In order to maintain our records, we require the following
                        information from you. Please complete the form with your
                        real and accurate data, all records are checked manually.
                        Any incomplete or fraudulent data submitted will result in 
                        the termination of your account.</p>          
                
                        <hr id="divider">
                    
                        <div class="col-md-6">
                            <div class="default-section panel panel-info">
                                <div class="panel-heading">
                                    <b>General information</b>
                                </div>
                                <div class="panel-body"> 
                                    <div id="general-info-position">
                                        <img id="profile-pic" src="/image/profile.jpg" class="img-circle" height="80px" width="80px"/>
                                        <br><br>
                                        <b>&nbsp User</b>: &nbsp{{ $user->username }}
                                        <br><br>
                                        <b>E-mail</b>: &nbsp{{ $user->email }}
                                        <br><br>
                                        <b>&nbsp Role</b>: &nbsp{{ $user->role }}           
                                    </div>
                                  
        
                                </div>      
                            </div>        
                        </div>
          
                        <div class="col-md-6">
                            <div class="default-section panel panel-success">
                                <div class="panel-heading">
                                    <b>Update Password </b>
                                </div>
                                <div class="row">
                                    <div id="session-position" class="col-md-11">
                                        @if(Session::has('error'))
                                            <div class="alert alert-danger" role ="alert">
                                                {{ Session::get('error') }}
                                            </div>
                                        @elseif(Session::has('success'))
                                            <div class="alert alert-success" role ="alert">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif                  
                                    </div>
                                </div>
                                {{ Form::open([ 'class'=>'form-horizontal', 'route'=>['publisher-changePassword',$user->username]]) }}
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="current-password" class="col-sm-3 control-label">Current:</label>
                                            <div class="col-sm-7 @if ($errors->has('current-password')) has-error @endif">
                                                <input type="password" class="form-control" name="current-password">
                                                @if ($errors->has('current-password')) 
                                                    <p class="help-block">{{ $errors->first('current-password') }}</p> 
                                                @endif
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="new-password" class="col-sm-3 control-label">New:</label>
                                            <div class="col-sm-7 @if ($errors->has('new-password')) has-error @endif">
                                                <input type="password" class="form-control" name="new-password">
                                                @if ($errors->has('new-password')) 
                                                    <p class="help-block">{{ $errors->first('new-password') }}</p> 
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password" class="col-sm-3 control-label">Confirm:</label>
                                            <div class="col-sm-7 @if ($errors->has('confirm-password')) has-error @endif">
                                                <input type="password" class="form-control" name="confirm-password">
                                                @if ($errors->has('confirm-password')) 
                                                    <p class="help-block">{{ $errors->first('confirm-password') }}</p> 
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-offset-4 col-sm-4">
                                            <div class="form-group">                  
                                                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>  
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}        
                            </div>
                            <div class="default-section panel panel-default">
                                <div class="panel-heading">
                                    <b>Payment </b>
                                </div>
                                <div class="panel-body">
                                    <a href="" data-paypal-button="true">
                                        <img src="//www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout.gif" alt="Check out with PayPal" />
                                    </a>
                                </div>
                            </div>                                           
                        </div>               
                             
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop