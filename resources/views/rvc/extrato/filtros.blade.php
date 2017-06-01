<div id="panel-filtros" class="panel panel-default" style='margin-top:10px' >
	  <div class="panel-heading" id="panel-filtros-heading">
	    <div class='container-fluid'>
	    <h3 class="panel-title"><i aria-hidden="true" class="fa fa-table"></i>&nbsp Filtros 
	    						<i aria-hidden="true" class="fa fa-caret-square-o-down pull-right"></i> </h3>
	   	</div>
	  </div>
	  <div id="panel-filtros-body" class="panel-body collapse">
	  <form id="form-filtros" class='form-horizontal'>
		  <div class='container-fluid'>
		  		<div class='form-group'>
		  			 <div class='col-md-3'>
		  			 		<label class='control-label pull-right' for="origem"> Origem </label>  
		  			 </div>
		  			 <div class='col-md-4'>
		  			 		<input name="origem" id="origem" type="text" class='form-control'>
		  			 </div> 
		  		</div>
		  		
		  		<div class='form-group'>
		  			 <div class='col-md-3' >
		  			 		<label class='control-label pull-right' for="destino"> Destino </label>  
		  			 </div>
		  			 <div class='col-md-4'>
		  			 		<input name="destino" type="text" class='form-control'>
		  			 </div> 
		  		</div>
		  		
		  		<div class='form-group'>
		  			 <div class='col-md-3'>
		  			 		<label class='control-label pull-right'> Data </label>  
		  			 </div>
		  			 <div class='col-md-6'>
		  			 		<div class='col-md-6' style="padding-left:0"> 
		  			 			<input name="data_min" type="text" class='form-control' placeholder="Mínima"> 
		  			 		</div>
		  			 		<div class='col-md-6'> 		  			 		
		  			 			<input name="data_max" type="text" class='form-control' placeholder="Máxima">
		  			 		</div>
		  			 </div> 
		  		</div>

		  		<div class='form-group'>
		  			 <div class='col-md-3'>
		  			 		<label class='control-label pull-right' for="cpf"> Duração </label>  
		  			 </div>
		  			 <div class='col-md-6'>
		  			 		<div class='col-md-6' style="padding-left:0"> 
		  			 			<input name="duracao_min" type="text" class='form-control' placeholder="Mínima"> 
		  			 		</div>
		  			 		<div class='col-md-6'> 		  			 		
		  			 			<input name="duracao_max" type="text" class='form-control' placeholder="Máxima">
		  			 		</div>
		  			 </div> 
		  		</div>

		  		<div class='form-group'>
		  			 <div class='col-md-3'>
		  			 		<label class='control-label pull-right' for="cpf"> Valor </label>  
		  			 </div>
		  			 <div class='col-md-6'>
		  			 		<div class='col-md-6' style="padding-left:0"> 
		  			 			<input name="valor_min" type="text" class='form-control' placeholder="Mínimo"> 
		  			 		</div>
		  			 		<div class='col-md-6'> 		  			 		
		  			 			<input name="valor_max" type="text" class='form-control' placeholder="Máximo">
		  			 		</div>
		  			 </div> 
		  		</div>

		  </div>

		  <button class="btn btn-warning btn-block"> <i class="fa fa-search" aria-hidden="true"></i> Filtrar </button>
	  </form>
	  </div>
</div>

@push("scripts")
<script type="text/javascript">
	$(function(){

		$("#form-filtros").on("submit", function(ev){
			ev.preventDefault();
			$('#table-extrato').DataTable().ajax.reload();
			//$('#table-exportacoes').DataTable().ajax.reload();
		});

		$("#panel-filtros-heading").on("click", function(){
			$(this).parent().find(".panel-body").collapse('toggle')
		});
	})
</script>
@endpush("scripts")

