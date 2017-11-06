@extends('base.base')

@section('content')
	
<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Grupos de atendimento 
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>

	
    <div class="panel-body"  id="body-grupos">
       	<div class='container-fluid'>
	       	<div class='row'>
				<a href="{{route('rvc.saudacoes.create')}}" class='btn btn-success btn-block'> Criar Saudação </a>
	       	</div>
	       	<hr>
	       	@include("rvc.saudacoes.datatables")
		</div>
	</div>
</div>


@endsection
