@extends('layouts.default')

@section('navbar')
    <ul id="navs" class="nav navbar-nav">
        <li class="active">
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
    <!-- <div id="menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline">
                        <li class="active"><a href="{{ URL::route('publisher-dashboard') }}">Dashboard</a></li>
                        <li><a href="">Documentation</a></li>
                        <li><a href="{{ URL::route('publisher-profile', $user->username) }}">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-xs-9 col-sm-3" id="sidebar" role="navigation">
                <div class="list-group">    
                    <a class="list-group-item list-group-header" href="{{ URl::route('publisher-getApps') }}" >
                        Application  
                        <span class="badge">{{ count($user->apps) }}</span>
                    </a>    
                    <a class="list-group-item" href="#" data-toggle="modal" data-target="#myModal" >
                        <span class="fa fa-plus-circle"></span> New App
                    </a>
                   
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

                <div id="profile"></div>

                <div class="w-bg default-section">
                    <div class="row">
                        <div class="col-sm-2">
                            <center>
                            <img src="/image/profile.jpg" class="img-thumbnail" />
                            </center>
                        </div>
                        <div class="col-sm-5">
                            <br>
                            {{ $user->username }}<br>
                            <em>{{ $user->email }}</em>
                        </div>
                        <div class="col-sm-5">
                            <br>
                            <span class="fa fa-eye"></span> Views: {{ $user->views }}<br>
                            <span class="fa fa-database"></span> Earnings: {{ $user->views * 2 }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">    
                <div class="default-section panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Graphs & Charts</h3>
                    </div>
                    <div id="curve_chart" style="width: 650px; height: 475px" class="panel-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 

@include('publishers.app-modal')
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
