@extends("base.base")

@section("content")

{!! Form::open(['route' => ['rv.planos.store'], 'method'=>'post', 'id'=>'form-planos']) !!}
	@include("rv.planos.formfields")
{!! Form::close() !!}
@endsection
