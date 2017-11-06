@extends("base.base")

@section("content")

{!! Form::model($configuracoes, ['route' => ['rv.configuracoes.update', $configuracoes->id], 'method'=>'POST', 'id'=>'form-configuracoes']) !!}
	
@include('rv.configuracoes.formfields_complete')

{!! Form::close() !!}

@endsection