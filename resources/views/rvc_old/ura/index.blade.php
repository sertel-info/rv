@extends('base.base')

@push("headers")
	<link rel="stylesheet" type="text/css" href="/css/file_upload.css">
@endpush

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Atualizar URA </h3>
  </div>
  <div class="panel-body">
  	<div class="container-fluid">
	  	<div class='row'>
		   	
			@if(isset($ura))
				{!! Form::model($ura, ['route' => ['rvc.ura.update'], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
		    @else
		    	<form method="POST" action="{{route('rvc.ura.update')}}" enctype="multipart/form-data">
		    @endif
		    
		    {{csrf_field()}}
			
			@include("rvc.ura.formfields")

			<button class="btn btn-success btn-block"> Salvar </button>
			
			{{Form::close()}}
			
	 	 </div>
	</div>
	</div>
</div>

	

@endsection
