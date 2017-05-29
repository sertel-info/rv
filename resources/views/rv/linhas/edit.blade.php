@extends("base.base")

@section("content")

{!! Form::model($linha, ['route' => ['rv.linhas.update'], 'method'=>'put', 'id'=>'form-linhas']) !!}
	{{Form::hidden('_id', $linha->id)}}
	{{Form::hidden('_id_did', $linha->id_did)}}
	@include("rv.linhas.formfields_complete")

{!! Form::close() !!}

@endsection
