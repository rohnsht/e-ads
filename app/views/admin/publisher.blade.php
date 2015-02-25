@extends('layouts.admin')

@section('content')  
      <div id ="stack" class="pull-left">   
        <ul class = "nav nav-pills nav-stacked">    
          <li><a href = "{{ URL::route('get-advertiser') }}">Advertisers</a></li> 
          <li><a href = "{{ URL::route('admin-home') }}">Home</a></li>   
          <li class="active"><a href = "{{ URL::route('get-user') }}">Publishers</a></li>
        </ul>
        </div>

      <div class="container">
        <div class="col-md-12">
          <div class="panel panel-default" style = "margin-top: 10px">
            <div class="panel-heading"><hx class = "panel-title">Users</hx></div>                    
             <table class="table table-bordered">
               <thead>
                 <tr>
                   <th>Name</th>
                   <th>Email</th>
                 </tr>
               </thead>
               <tbody>
                @foreach($data as $user)  
                 <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>       
                  </tr> 
                @endforeach     
               </tbody>
             </table>         
          </div>
        </div>
      </div>
@stop       
