@extends('base.base')

@section('content')

	{{Form::model($fila, ['route'=>['rvc.filas.update', 'f'=>$fila->id_md5], 'method'=>'put', 'id'=>'form-filas'])}}
		@include("rvc.filas.formfields")
		<br>
		<button class='btn btn-success btn-block'> Salvar </button>
	{{Form::close()}}

@endsection
