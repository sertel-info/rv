@extends("base.base")

@section("content")

{!! Form::model($plano, ['route' => ['rv.planos.update', $plano->id], 'method'=>'PUT', 'id'=>'form-planos']) !!}
	@include("rv.planos.formfields")
{!! Form::close() !!}

@endsection
