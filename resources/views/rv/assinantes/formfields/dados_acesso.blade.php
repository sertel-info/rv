
<div class="panel panel-default panel-toggle">
    <div class="panel-heading"  data-toggle="collapse" data-target="#body-acesso">
          <h3 class="panel-title">Dados de Acesso
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
          </h3>
    </div>

    <div class="panel-body collapse" id="body-acesso">
                    <div class="form-group row">
						<label for="nome_acesso" class="col-md-4 col-form-label">Nome</label>
						<div class="col-md-8">
							{{Form::text('nome_acesso', null, ['class'=>'form-control'])}}
						    
						</div>
					</div>

					<div class="form-group row">
						<label for="email_acesso" class="col-md-4 col-form-label">Email</label>
						<div class="col-md-8">
							{{Form::text('email_acesso', null, ['class'=>'form-control'])}}
						    
						</div>
					</div>

					<div class="form-group row">
						<label for="senha_acesso" class="col-md-4 col-form-label"> Senha </label>
						<div class="col-md-8">
							{{Form::password('senha_acesso', ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="status" class="col-md-4 col-form-label"> Status  </label>
						<div class="col-md-8">
						    {{Form::select('status', ["1"=>"Ativo", "0"=>"Inativo"], null,['class'=>'form-control'])}}
						 
						</div>
					</div>
	</div>

</div>