
<div class="panel panel-default panel-toggle">
    <div class="panel-heading" data-toggle="collapse" data-target="#body-facilidades">
        <h3 class="panel-title">Facilidades
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
        </h3>
    </div>

    <div class="panel-body collapse" id="body-facilidades">
                    <div class="form-group row">
						
						<div class='col-md-4'>
							<center>
								<label for="acesso_ramais" class=""> Acesso a Ramais </label><br>
								{{Form::checkbox('acesso_ramais', 1, isset($assinante->acesso_ramais) ? $assinante->acesso_ramais : null, ['data-size'=>'mini'])}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="portal_voz" class=""> Portal de Voz </label><br>
								{{Form::checkbox('portal_voz', 1, isset($assinante->portal_voz) ? $assinante->portal_voz : null, ['data-size'=>'mini'])}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="envio_sms" class=""> Envio de SMS </label><br>
								{{Form::checkbox('envio_sms', 1, isset($assinante->envio_sms) ? $assinante->envio_sms : null, ['data-size'=>'mini'])}}
							</center>
						</div>

					</div>

					<div class="form-group row">
						
						<div class='col-md-4'>
							<center>
								<label for="salas_conferencia" class=""> Salas de Conferência </label><br>
								{{Form::checkbox('salas_conferencia', 1, isset($assinante->salas_conferencia) ? $assinante->salas_conferencia : null, ['data-size'=>'mini'])}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="filas_atendimento" class=""> Filas de Atendimento  </label><br>
								{{Form::checkbox('filas_atendimento', 1, isset($assinante->filas_atendimento) ? $assinante->filas_atendimento : null, ['data-size'=>'mini'])}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="ura_atendimento" class=""> URA de Atendimento </label><br>
								{{Form::checkbox('ura_atendimento', 1, isset($assinante->ura_atendimento) ? $assinante->ura_atendimento : null, ['data-size'=>'mini'])}}
							</center>
						</div>
					
					</div>
	</div>

</div>
