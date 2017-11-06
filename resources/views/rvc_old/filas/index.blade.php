@extends('base.base')

@section('content')

<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Criar Fila
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>

    <div class="panel-body"  id="body-grupos">
	    <div class='container-fluid'>
			    <div class='row'>
				<a class='btn btn-block btn-success' href="{{route('rvc.filas.create')}}"> Criar Fila </a>
			    </div>
			    <hr>
			    @include("rvc.filas.datatables")
		</div>
	</div>	
</div>

@endsection
