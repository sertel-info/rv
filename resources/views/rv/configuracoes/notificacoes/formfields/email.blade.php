
<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Email </h3>
    </div>

    <div class="panel-body">
		<div class='form-group'>
			<div class="row">
				<label for="ativar_email" class="col-md-4 col-form-label">
					Envio de email
				</label>
				<div class="col-md-8">
					{{Form::checkbox('ativar_email', 1, null, [])}}
				</div>
			</div>
			<div class='collapse'>					
				<div class="row" style="margin-top:15px">
					<label for="assunto_email" class="col-md-4 col-form-label">
						Assunto do email
					</label>
					<div class="col-md-8">
						{{Form::text('email_assunto', null, ['class'=>'form-control'])}}
					</div>
				</div>
									
				<div class="row" style="margin-top:15px">
					<label for="corpo_email" class="col-md-4 col-form-label">
						Texto do Email
					</label>
					<div class="col-md-8">
						{{Form::textarea('email_corpo', null, ['class'=>'form-control', 'rows'=>'4'])}}
					</div>
				</div>

			</div>
		</div>
	</div>
</div>