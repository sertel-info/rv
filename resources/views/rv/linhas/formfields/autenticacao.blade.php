<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-autenticacao">
        <h3 class="panel-title"> Autenticacao
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    <div class="panel-body collapse"  id="body-autenticacao">
                       
                    <div class="form-group row">
						<label for="login_ata" class="col-md-4 col-form-label">Login ATA</label>
						<div class="col-md-8">
						    {{Form::text("login_ata", null, ['class'=>'form-control'])}}						
						</div>
					</div>

					<div class="form-group row">
						<label for="usuario" class="col-md-4 col-form-label">Usuário</label>
						<div class="col-md-8">
						    {{Form::text("usuario", null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="senha" class="col-md-4 col-form-label">Senha</label>
						<div class="col-md-8">
						    {{Form::text("senha", null, ['class'=>'form-control'])}}						
						</div>
					</div>

					<!-- <div class="form-group row">
						<label for="numero" class="col-md-4 col-form-label">Número Linha</label>
						<div class="col-md-8">
						    {{Form::text("numero", null, ['class'=>'form-control'])}}						
						</div>
					</div> -->

					<div class="form-group row">
						<label for="ip" class="col-md-4 col-form-label">Endereço IP </label>
						<div class="col-md-8">
							{{Form::text("ip", null, ['class'=>'form-control'])}}		
						</div>
					</div>

					<div class="form-group row">
						<label for="porta" class="col-md-4 col-form-label">Porta</label>
						<div class="col-md-8">
							{{Form::text("porta", (isset($linha->porta) ? $linha->porta : "5060"), ['class'=>'form-control'])}}								
						</div>
					</div>

					
	</div>
</div>

