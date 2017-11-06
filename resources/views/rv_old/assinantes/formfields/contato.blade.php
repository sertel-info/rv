<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-contato">
        <h3 class="panel-title">Dados de Contato 
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    <div class="panel-body collapse"  id="body-contato">
                    
                    <div class="form-group row">
						<label for="cep" class="col-md-4 col-form-label">Cep</label>
						<div class="col-md-8">
							{{Form::text('cep', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="endereco" class="col-md-4 col-form-label"> Endereço </label>
						<div class="col-md-8">
							{{Form::text('endereco', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="complemento" class="col-md-4 col-form-label"> Complemento </label>
						<div class="col-md-8">
							{{Form::text('complemento', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="bairro" class="col-md-4 col-form-label"> Bairro </label>
						<div class="col-md-8">
							{{Form::text('bairro', null, ['class'=>'form-control'])}}
						</div>
					</div>

                    <div class="form-group row">
						<label for="cidade" class="col-md-4 col-form-label"> Cidade </label>
						<div class="col-md-8">
							{{Form::text('cidade', null, ['class'=>'form-control'])}}
						</div>
					</div>

                    <div class="form-group row">
						<label for="estado" class="col-md-4 col-form-label"> Estado/UF </label>
						<div class="col-md-8">
							{{Form::text('estado', null, ['class'=>'form-control'])}}
						</div>
						</div>

                    <div class="form-group row">
						<label for="pais" class="col-md-4 col-form-label"> País </label>
						<div class="col-md-8">
							{{Form::text('pais', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label"> E-Mail </label>
						<div class="col-md-8">
							{{Form::text('email', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="site" class="col-md-4 col-form-label"> Site/Homepage </label>
						<div class="col-md-8">
							{{Form::text('site', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="telefone" class="col-md-4 col-form-label"> Telefone </label>
						<div class="col-md-8">
							{{Form::text('telefone', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="fax" class="col-md-4 col-form-label"> Num. Fax </label>
						<div class="col-md-8">
							{{Form::text('fax', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="celular" class="col-md-4 col-form-label"> Celular </label>
						<div class="col-md-8">
							{{Form::text('celular', null, ['class'=>'form-control'])}}
						</div>
					</div>
	</div>
</div>

