@extends("base.base")

@section("content")

{!! Form::open(['route' => ['rv.linhas.store'], 'method'=>'post', 'id'=>'form-linhas']) !!}
	@include("rv.linhas.formfields_complete")
{!! Form::close() !!}
@endsection
