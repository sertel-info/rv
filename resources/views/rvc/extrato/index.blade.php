@extends('base.base')

@section('content')

	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Selecione a linha </h3>
  </div>
  <div class="panel-body">
  	<div class="container-fluid">
	  	<div class='row'>
		   	
			<a href="{{route('rvc.extrato.show')}}" class="btn btn-default btn-block"> Todas </a>

			@each('rvc.extrato.line_bar', $linhas, 'linha')
			
	 	 </div>
	</div>
	</div>
</div>


@endsection