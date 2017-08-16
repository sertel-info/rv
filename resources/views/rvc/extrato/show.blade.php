@extends('base.base')

@section('content')
	
	@include("rvc.extrato.filtros")

   <div class="panel panel-default">
	   <div class="panel-heading">
	   		<div class="pull-left">
	   			<h3 class="panel-title">Extrato</h3>
	   		</div>
	   		<div class="pull-right">
	   			@include("rvc.extrato.export_btn")
	   		</div>
	   		<div class="clearfix"></div>
	   </div>
	   <div class="panel-body">
		  	<div class="container-fluid">
			  	<div class='row'>
			  		@include("rvc.extrato.datatables")
	  			</div>
			</div>
		</div>
    </div>

@endsection