@extends('base.base')

@section('content')

	@include("rvc.gravacoes.player")

	@include("rvc.gravacoes.filtros")
	@include("rvc.gravacoes.datatables")

@endsection