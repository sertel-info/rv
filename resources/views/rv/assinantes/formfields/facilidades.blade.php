
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
								<label for="gravacoes" class=""> Gravações </label><br>
								{{Form::checkbox('gravacoes', 1, isset($assinante->gravacoes) ? $assinante->gravacoes : null)}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="correio_voz" class=""> Correio de Voz </label><br>
								{{Form::checkbox('correio_voz', 1, isset($assinante->correio_voz) ? $assinante->correio_voz : null)}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="grupos_atendimento" class=""> Grupos de Atendimento </label><br>
								{{Form::checkbox('grupos_atendimento', 1, isset($assinante->grupos_atendimento) ? $assinante->grupos_atendimento : null)}}
							</center>
						</div>

					</div>

					<div class="form-group row">

						<div class='col-md-4'>
							<center>
								<label for="fila" class=""> Filas de Atendimento  </label><br>
								{{Form::checkbox('fila', 1, isset($assinante->fila) ? $assinante->fila : null)}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="saudacoes" class=""> Áudio de saudação  </label><br>
								{{Form::checkbox('saudacoes', 1, isset($assinante->saudacoes) ? $assinante->saudacoes : null)}}
							</center>
						</div>

						<div class='col-md-4'>
							<center>
								<label for="ura" class=""> URA de Atendimento </label><br>
								{{Form::checkbox('ura', 1, isset($assinante->ura) ? $assinante->ura : null)}}
							</center>
						</div>
					
					</div>

					<div class="form-group row">

						<div class='col-md-4'>
							<center>
								<label for="acesso_extrato" class=""> Acesso ao extrato  </label><br>
								{{Form::checkbox('acesso_extrato', 1, isset($assinante->acesso_extrato) ? $assinante->acesso_extrato : null)}}
							</center>
						</div>
					</div>

	</div>

</div>
