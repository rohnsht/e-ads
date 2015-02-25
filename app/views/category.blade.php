@extends('layouts.main')

@section('content')
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Education
				</div>
				<div class="panel-body">
					
					@foreach($data as $data)
						<div class="col-md-3">
							<img class="img-responsive" src="/{{ $data->ads }}" />
							<p>{{ $data->title }}</p>
						</div>
					@endforeach
					
				</div>
			</div>
		</div>	
	</div>
@stop

@section('js')
	@parent
@stop