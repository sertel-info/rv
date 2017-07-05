@extends('base.base')

@section('content')

<div class="panel-body"  id="body-grupos">
    <div class='container-fluid'>
	    <div class='row'>
		<a class='btn btn-block btn-success' href="{{route('rvc.atendimento_automatico.create')}}"> Cirar Regra </a>
	    </div>
	    <hr>
	    @include("rvc.atendimento_automatico.datatables")
	</div>
</div>

@endsection
