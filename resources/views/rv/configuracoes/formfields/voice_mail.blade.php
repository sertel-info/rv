<div class="panel panel-default panel-toggle">
    <div class="panel-heading"  data-toggle="collapse" data-target="#body-voice-mail">
          <h3 class="panel-title"> Voice Mail
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
          </h3>
    </div>

    <div class="panel-body collapse" id="body-voice-mail">
                        <div class="form-group row">
						<label for="voice_mail_remetente_padrao" class="col-md-4 col-form-label">Remetente Padrão</label>
						<div class="col-md-8">
							{{Form::text('voice_mail_remetente_padrao', null, ['class'=>'form-control'])}}
						    
						</div>
					</div>

					<div class="form-group row">
						<label for="voice_mail_assunto_padrao" class="col-md-4 col-form-label"> Mensagem Padrão </label>
						<div class="col-md-8">
							{{Form::textarea('voice_mail_assunto_padrao', null, ['class'=>'form-control', 'style'=>'max-height:120px'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="voice_mail_mensagem_padrão" class="col-md-4 col-form-label"> Assunto Padrão </label>
						<div class="col-md-8">
							{{Form::text('voice_mail_mensagem_padrao', null, ['class'=>'form-control'])}}
						</div>
					</div>

	</div>

</div>