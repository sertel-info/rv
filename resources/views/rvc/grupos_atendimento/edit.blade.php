
@extends('base.base')

@push("headers")
	<link rel="stylesheet" type="text/css" href="/css/picklist.css">
@endpush
@section('content')
	<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Criar Grupo
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>

    <div class="panel-body"  id="body-grupos">
       	<div class='container-fluid'>
        	{!! Form::model($grupo, ['route' => ['rvc.grupos_atendimento.update', $grupo->id_md5],
        							 'method'=>'PUT', 'id'=>'form-grupos'],
        							 ['class'=>'form-grupos']) !!}
       		<!--<form id="form-grupos" method="POST" action="{{route('rvc.grupos_atendimento.store')}}"> -->
				@include("rvc.grupos_atendimento.formfields")
				<br>
				<button class='btn btn-block btn-success'> Salvar </button>
			{{Form::close()}}
		</div>
	</div>
	</div>
@endsection

