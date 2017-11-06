
<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-configuracoes-gerais">
        <h3 class="panel-title">Configurações Gerais
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
        </h3>
    </div>

    <div class="panel-body collapse" id="body-configuracoes-gerais">
	 
		<div class="form-group row">
			<label for="callerid" class="col-md-4 col-form-label"> CallerID </label>
			<div class="col-md-8">
				{{Form::text("callerid", null, ['class'=>'form-control'])}}						
			</div>
		</div>

		<div class="form-group row">
			<label for="call_group" class="col-md-4 col-form-label"> Call Group </label>
			<div class="col-md-8">
				{{Form::text("call_group", null, ['class'=>'form-control'])}}						
			</div>
		</div>

		<div class="form-group row">
			<label for="pickup_group" class="col-md-4 col-form-label"> Pickup Group </label>
			<div class="col-md-8">
				{{Form::text("pickup_group", null, ['class'=>'form-control'])}}						
			</div>
		</div>

		<div class="form-group row">
			<label for="envio_dtmf" class="col-md-4 col-form-label"> Envio de DTMF </label>
			<div class="col-md-8">
				{{Form::select("envio_dtmf", ['auto'=>'AUTO (Automático)',
												   'rfc2833'=>'RFC2833 (padrão)',
												   'inband'=>'INBAND (Apenas G711)',
												   'info'=>'INFO' ], null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group row">
			<label for="ring_falso" class="col-md-4 col-form-label"> Ring Falso </label>
			<div class="col-md-8">
				{{Form::checkbox('ring_falso', 1, null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group row">
			<label for="nat" class="col-md-4 col-form-label"> NAT </label>
			<div class="col-md-8">
				{{Form::checkbox('nat', 1, null, ['class'=>'form-control'])}}
			</div>
		</div>

    </div>

</div>