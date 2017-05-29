<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-financeiro">
        <h3 class="panel-title">Dados Financeiros
        	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
        </h3>
    </div>
    <div class="panel-body collapse" id="body-financeiro">
                    <div class="form-group row">
						<label for="dias_bloqueio" class="col-md-4 col-form-label"> Dias para bloqueio </label>
						<div class="col-md-8">
							{{Form::text('dias_bloqueio', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="dia_vencimento" class="col-md-4 col-form-label"> Dia do Vencimento </label>
						<div class="col-md-8">
							{{Form::text('dia_vencimento', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="limite_credito" class="col-md-4 col-form-label"> Limite Crédito </label>
						<div class="col-md-8">
							{{Form::text('limite_credito', null, ['class'=>'form-control'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="alerta_saldo" class="col-md-4 col-form-label"> Alerta de Saldo </label>
						<div class="col-md-8">
							{{Form::text('alerta_saldo', null, ['class'=>'form-control'])}}
						</div>
					</div>


                    <div class="form-group row">
						<label for="espaco_disco" class="col-md-4 col-form-label"> Espaço em Disco </label>
						<div class="col-md-8">
							{{Form::text('espaco_disco', null, ['class'=>'form-control'])}}
						</div>
					</div>

					@if(Request::url() == route('rv.assinantes.create'))
						<div class="form-group row">
							<label for="creditos" class="col-md-4 col-form-label"> Créditos iniciais</label>
							<div class="col-md-8">
								{{Form::text('creditos', null, ['class'=>'form-control']) }}
							</div>
						</div>
					@endif
	</div>

</div>

