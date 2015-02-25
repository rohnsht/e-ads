@extends('layouts.default')

@section('navbar')
    <ul id="navs" class="nav navbar-nav">
        <li class="active">
            <a href="{{ URL::route('advertiser-dashboard') }}">
                <span class="glyphicon glyphicon-flash"></span> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ URL::route('advertiser-postAds') }}">
                <span class="glyphicon glyphicon-plus-sign"></span> Post Ads
            </a>
        </li>
        <li><a href="{{ URL::route('advertiser-profile', $data->username) }}">
            <span class="glyphicon glyphicon-edit"></span> Profile
        </a></li>
    </ul>

    {{ Form::open(['class'=>'navbar-form navbar-left','route'=>'advertiser-search']) }}
        <div class="input-group">    
            <input type="search" name="search" class="form-control input-sm" placeholder="Search advertisement">
            <span class="input-group-btn">
                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> Search</button>
            </span>
        </div>
    {{ Form::close() }}
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
                <div class="col-md-8">
                    <ul class="list-inline">
                        <li class="active"><a href="{{ URL::route('advertiser-dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ URL::route('advertiser-postAds') }}">Post Ads</a></li>
                        <li><a href="{{ URL::to('advertiser', $data->username) }}">Profile</a></li>

                    </ul>
                </div>
                <div class="col-md-4">
                    {{ Form::open(['route'=>'advertiser-search']) }}
                    <div class="input-group">    
                        <input type="search" name="search" class="form-control input-sm" placeholder="Search advertisement by title">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"> Search</i></button>
                        </span>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="header-text">Your Advertisements</h2>
                    </div>
                    @if(Session::has('result'))
                        <div class="panel-body">
                            <em>Search result</em>
                            @foreach(Session::get('result') as $result)
                                <div class="media">
                                <a class="media-left">
                                    <img src="{{ $result->ads }}" alt="{{ $result->title }}" height="120px" width="120px">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $result->title }}</h4>
                                    <p>Category : {{ $result->category }}</p>
                                        
                                    {{ Form::open(['method'=>'PUT','route'=>['advertiser-ads-update',$result->id],'id'=>'updateForm']) }}
                                        @if($result->activation == 1)
                                            <button type="submit" class="btn btn-warning btn-sm">Deactivate</button>
                                        @elseif($result->activation == 0)
                                            <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                        @endif
                                    {{ Form::close() }}

                                    {{ Form::open(['method'=>'DELETE','route'=>['advertiser-ads-delete',$result->id],'id'=>'deleteForm']) }}
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif(Session::has('no-result'))  
                        <div class="panel-body">
                            <em>Search result</em>
                            <h3>{{ Session::get('no-result') }}</h3>
                        </div>  
                    @else
                        <div class="panel-body">   
                            @if(count($views) == 0)
                                <center><i class="fa fa-trash-o" style="font-size:100px"></i></center>
                                <p> You have not posted any advertisement yet.
                                    <a href="{{ URL::route('advertiser-postAds') }}">Click here</a> to post your advertisement.
                                </p>
                            @elseif(count($views) >= 1)
                                @foreach($views as $adsData)                   
                                <div class="media">
                                    <a class="media-left">
                                        <img src="{{ e($adsData->ads) }}" alt="{{ e($adsData->title) }}" height="120px" width="120px">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ e($adsData->title) }}</h4>
                                        <p>Category : {{ $adsData->category }}</p>
                                        <p>Views : {{ count($adsData->views) }}</p>
                                   
                                        {{ Form::open(['method'=>'PUT','route'=>['advertiser-ads-update',$adsData->id],'id'=>'updateForm']) }}
                                            @if($adsData->activation == 1)
                                                <button type="submit" class="btn btn-warning btn-sm">Deactivate</button>
                                            @elseif($adsData->activation == 0)
                                                <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                            @endif
                                        {{ Form::close() }}

                                        {{ Form::open(['method'=>'DELETE','route'=>['advertiser-ads-delete',$adsData->id],'id'=>'deleteForm']) }}
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    
                </div>  

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Advertisement Views</h3>
                    </div>
                    <div id="curve_chart" style="width: 600px; height: 450px" class="panel-body">
                        
                    </div>
                </div>    
            </div>

            <div class="col-md-4">  
                <div class="default-section w-bg">
                    <div class="profile-pic">
                    
                        <img src="image/profile.jpg" height="100px" width="100px" />
                    
                    </div>
                
                    <h3>{{ $data->username }}</h3>
                    <em>{{ $data->email }}</em><br>
                    Rs. {{ $data->views * 4 }}
        
                </div>
                     
                <div class="panel panel-info">
                    <div class="panel-heading">
                        New to e-ads?
                    </div>
                    <div class="panel-body">
                        <p>You can post your advertisements by navigating to post-ads page and follow the
                        given instructions. Choose a suitable category while posting your advertisement.

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript"
            src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Views'],
                ['{{ $date[0] }}',  {{ count($vpd[0]) }}],
                ['{{ $date[1] }}',  {{ count($vpd[1]) }}],
                ['{{ $date[2] }}',  {{ count($vpd[2]) }}],
                ['{{ $date[3] }}',  {{ count($vpd[3]) }}],
                ['{{ $date[4] }}',  {{ count($vpd[4]) }}],
                ['{{ $date[5] }}',  {{ count($vpd[5]) }}],
                ['{{ $date[6] }}',  {{ count($vpd[6]) }}]
            ]);

            var options = {
                title: 'Views of a week',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
@stop