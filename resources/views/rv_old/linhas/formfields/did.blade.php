<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-did">
        <h3 class="panel-title"> DID
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    <div class="panel-body collapse"  id="body-did">
    				<div class='col-md-12'>
						<div class="form-group row">
							<label for="status_did" class="col-md-4 col-form-label"> Status </label>
							<div class="col-md-8">
								{{Form::checkbox('status_did', 1, null, ['class'=>'form-control','data-size'=>'small', 'onText'=>'ativado', 'offText'=>'desativado'])}}
							</div>
						</div>

					</div>

					<div id='form-did' class='collapse'>
						<div class="form-group row">
							<label for="usuario" class="col-md-4 col-form-label">Usuário</label>
							<div class="col-md-8">
							    {{Form::text("usuario_did", null, ['class'=>'form-control'])}}
							</div>
						</div>

						<div class="form-group row">
							<label for="senha" class="col-md-4 col-form-label">Senha</label>
							<div class="col-md-8">
							    {{Form::text("senha_did", null, ['class'=>'form-control'])}}						
							</div>
						</div>

						<div class="form-group row">
							<label for="ip" class="col-md-4 col-form-label">Endereço IP</label>
							<div class="col-md-8">
								{{Form::text("ip_did", null, ['class'=>'form-control'])}}		
							</div>
						</div>

						<div class="form-group row">
							<label for="extensao" class="col-md-4 col-form-label">Extensão</label>
							<div class="col-md-8">
								{{Form::text("extensao_did", null, ['class'=>'form-control'])}}								
							</div>
						</div>
					</div>
	</div>
</div>

