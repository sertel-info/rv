@extends("base.base")


@section("content")

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Selecione a linha </h3>
  </div>
  <div class="panel-body">
  	<div class="container-fluid">
	  	<div class='row'>
		   	
			@each('rvc.config.line_bar', $linhas, 'linha')
			
	 	 </div>
	</div>
	</div>
</div>


@endsection

