
<div class="panel panel-default panel-toggle">
    <div class="panel-heading"  data-toggle="collapse" data-target="#body-dados-basicos">
        <h3 class="panel-title">Dados Básicos 
        <div class="collapse-icon pull-right">
        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
        </div>
        </h3>
    </div>


    <div class="panel-body collapse" id="body-dados-basicos">
    				<div class='row' style="margin-bottom:30px">
	    				<div class='col-md-4'></div>
	    				<div class='col-md-4'>
	    				<input type="checkbox" name="tipo" 
	    				@if(isset($assinante))
	    					{{'readonly '.($assinante->tipo ? 'checked': '')}}
	    				@endif
	    				/>
	    				</div>
	    				<div class='col-md-4'></div>
    				</div>

                    <div class="form-group row" data-type="jur" style="display:none">
						<label for="nome_fantasia" class="col-md-4 col-form-label">Nome Fantasia</label>
						<div class="col-md-8">
						    {{Form::text('nome_fantasia', null, ['class'=>'form-control']) }}
						    
						</div>
					</div>

					<div class="form-group row" data-type="jur" style="display:none">
						<label for="razao_social" class="col-md-4 col-form-label"> Razão Social </label>
						<div class="col-md-8">
							{{Form::text('razao_social', null, ['class'=>'form-control']) }}

						</div>
					</div>

					<div class="form-group row" data-type="jur" style="display:none">
						<label for="cnpj" class="col-md-4 col-form-label"> CNPJ  </label>
						<div class="col-md-8">
							{{Form::text('cnpj', null, ['class'=>'form-control']) }}
						</div>
					</div>

					<div class="form-group row" data-type="fis" >
						<label for="nome" class="col-md-4 col-form-label"> Nome  </label>
						<div class="col-md-8">
							{{Form::text('nome', null, ['class'=>'form-control']) }}
						</div>
					</div>
					
					<div class="form-group row" data-type="fis" >
						<label for="sobrenome" class="col-md-4 col-form-label"> Sobrenome  </label>
						<div class="col-md-8">
							{{Form::text('sobrenome', null, ['class'=>'form-control']) }}
						</div>
					</div>

					<div class="form-group row" data-type="fis" >
						<label for="cpf" class="col-md-4 col-form-label"> CPF  </label>
						<div class="col-md-8">
							{{Form::text('cpf', null, ['class'=>'form-control']) }}
						</div>
					</div>

                    <div class="form-group row" data-type="jur" style="display:none">
						<label for="inscricao_estadual" class="col-md-4 col-form-label"> Inscrição E. </label>
						<div class="col-md-8">
							{{Form::text('inscricao_estadual', null, ['class'=>'form-control']) }}
						</div>
					</div>

					<div class="form-group row">
						<label for="plano" class="col-md-4 col-form-label"> Plano </label>
						<div class="col-md-8">
						{{Form::select('plano', $planos, null, ['class'=>'form-control '.(!count($planos) ? "hidden": "")]) }}
						
						@if(!count($planos))
							<div class="alert alert-warning" role="alert">
						    	<span>Nenhum <u>plano</u> cadastrado ! Clique
						    		<b><a class="alert-link" href="{{route('rv.planos.create')}}">Aqui</a></b>
						    			para cadastrar um.
						    	</span>
						    </div>
						@endif

						</div>
					</div>
	</div>

</div>

