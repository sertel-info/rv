<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-dados-basicos">
        <h3 class="panel-title">Dados Básicos 
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    
    <div class="panel-body collapse"  id="body-dados-basicos">
                    <div class="form-group row">
						<label for="nome" class="col-md-4 col-form-label">Nome</label>
						<div class="col-md-8">
						    {{Form::text('nome', null, ['class'=>'form-control'])}}
						</div>
					</div>

                    <div class="form-group row">
						<label for="tecnologia" class="col-md-4 col-form-label">Tecnologia</label>
						<div class="col-md-8">
						    {{Form::select("tecnologia", ["sip"=>"SIP"],null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="assinante" class="col-md-4 col-form-label">Assinante</label>
						<div class="col-md-8"> 
						    {{Form::select("assinante_id", $assinantes, null, 
						    			['class'=>'form-control '.(!count($assinantes) ? "hidden": "")])}}
						    @if(!count($assinantes))							
						    	<div class="alert alert-warning" role="alert">
						    		<span>Nenhum <u>assinante</u> cadastrado ! Clique
						    			<b><a class="alert-link" href="{{route('rv.assinantes.create')}}">Aqui</a></b>
						    			 para cadastrar um.
						    		</span>
						    	</div>
						    @endif
						</div>
					</div>

					<div class="form-group row">
						<label for="ddd_local" class="col-md-4 col-form-label">DDD Local</label>
						<div class="col-md-8">
							{{Form::text("ddd_local", null, ['class'=>'form-control'])}}						
						</div>
					</div>

                    <div class="form-group row">
						<label for="pla_simultaneas" class="col-md-4 col-form-label">Simultâneas</label>
						<div class="col-md-8">
						    {{Form::text("simultaneas", null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row" style="margin-top:30px">
						<label for="funcionalidade" class='col-md-4 col-form-label'> Funcionalidade </label>
						<div class='col-md-8'>
						    {{Form::select("funcionalidade", ["linha_ip"=>"LINHA IP"],
															 null, ['class'=>'form-control'])}}

						</div>
					</div>

					<div class="form-group row">
						<label for="cli" class="col-md-4 col-form-label"> Rota com CLI </label>
						<div class="col-md-8">
								{{Form::checkbox('cli', 1, null, ['class'=>'form-control'])}}
						</div>
					</div>


	</div>
</div>

