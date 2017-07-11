<div class="panel panel-default" id="panel-filtros">
  <div class="panel-heading">
    <h3 class="panel-title">Filtros</h3>
  </div>
  <div class="panel-body">
  	<div class="container-fluid">
	  	<div class='row'>
			<form class="form-horizontal" id="form-filtros">
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Tipo de chamada </label>
			    <div class="col-sm-4">
			     	<select name="tipo_chamada" class='form-control'>
			     		<option value="todos" selected> Todos </option>
			     		<option value="entrante"> Entrantes </option>
			     		<option value="sainte"> Saintes </option>
			     		<option value="interna"> Internas </option>
			     	</select>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Tipo de destino </label>
			    <div class="col-sm-4">
			      <select name="tipo_destino" class='form-control'>
			     		<option value="todos" selected> Todos </option>
			     		<option value="movel"> Móvel </option>
			     		<option value="fixo"> Fixo </option>
			     		<option value="interno"> Ramal </option>
			      </select>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Origem </label>
			    <div class="col-sm-4">
			      	<input type="text" name="origem" class="form-control"/>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Destino </label>
			    <div class="col-sm-4">
			      	<input type="text" name="destino" class="form-control"/>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Data </label>
			    <div class="col-sm-4">
			      <input type="text" name="data_min" class='form-control' placeholder="De" />
			    </div>
			    <div class="col-sm-4">
			      <input type="text" name="data_max" class='form-control' placeholder="Até"/>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Hora </label>
			    <div class="col-sm-4">
			      <input type="text" name="hora_min" class='form-control' placeholder="De" />
			    </div>
			    <div class="col-sm-4">
			      <input type="text" name="hora_max" class='form-control' placeholder="Até"/>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-3 control-label"> Duração </label>
			    <div class="col-sm-4">
			      <input type="text" name="duracao_min" class='form-control' placeholder="De" />
			    </div>
			    <div class="col-sm-4">
			      <input type="text" name="duracao_max" class='form-control' placeholder="Até"/>
			    </div>
			  </div>
			  
			  <div class="form-group row">
			    <div class="col-sm-offset-2 col-sm-10">
			      <a href="#" id="clear-form-filtros" class="btn btn-warning btn-block">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			      	Limpar filtros </a>
			    </div>
			  </div>
  
			  <div class="form-group row">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success btn-block">
			      	 <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
 					 Filtrar
 				  </button> 
			    </div>
			  </div>

			</form>

	    </div>
	</div>
  </div>
</div>


@push("scripts")
	<script type="text/javascript" src="/third_party/jquery/maskedInput.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#panel-filtros .panel-heading").on("click", function(){
				$("#panel-filtros .panel-body").collapse("toggle");
			});

			$("input[name=data_min], input[name=data_max]").mask("99/99/9999");
			$("input[name=duracao_min], input[name=duracao_max], input[name=hora_min], input[name=hora_max]").mask("99:99:99");

			$("#form-filtros").on("submit", function(ev){
				ev.preventDefault();
				$("#table-extrato").dataTable().api().draw();
			});

			$("#clear-form-filtros").on("click", function(ev){
				ev.preventDefault();
				var filtros = $("#form-filtros");

				filtros.find("select").val("todos").trigger("change");
				filtros.find("input[type=text]").val("");

				$("#table-extrato").dataTable().api().draw();
			});
		})
	</script>
@endpush