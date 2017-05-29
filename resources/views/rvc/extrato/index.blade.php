@extends('base.base')

@section('content')
	
	@each('rvc.extrato.line_bar', $linhas, 'linha')

@endsection