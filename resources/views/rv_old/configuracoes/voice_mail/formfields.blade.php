
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
