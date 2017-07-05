@extends('base.base')

@push("headers")
	<link rel="stylesheet" type="text/css" href="/css/file_upload.css">
@endpush

@section('content')
	
	@if(isset($ura))
		{!! Form::model($ura, ['route' => ['rvc.ura.update'], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    @else
    	<form method="POST" action="{{route('rvc.ura.update')}}" enctype="multipart/form-data">
    @endif
    
    {{csrf_field()}}
	
	@include("rvc.ura.formfields")

	<button class="btn btn-primary btn-block"> Salvar </button>
	
	{{Form::close()}}

@endsection
