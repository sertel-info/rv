
<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Email </h3>
    </div>

    <div class="panel-body">
		<div class='form-group'>
			<div class="row">
				<label for="notification_text" class="col-md-4 col-form-label">
					Envio de email
				</label>
				<div class="col-md-8">
					{{Form::checkbox('active_email', 1)}}
				</div>
			</div>
			<div class='collapse'>					
				<div class="row" style="margin-top:15px">
					<label for="email_subject" class="col-md-4 col-form-label">
						Assunto do email
					</label>
					<div class="col-md-8">
						{{Form::text('email_subject', null, ['class'=>'form-control'])}}
					</div>
				</div>
									
				<div class="row" style="margin-top:15px">
					<label for="email_body" class="col-md-4 col-form-label">
						Texto do Email
					</label>
					<div class="col-md-8">
						{{Form::textarea('email_body', null, ['class'=>'form-control', 'rows'=>'4'])}}
					</div>
				</div>

				<div class="row" style="margin-top:15px">
					<label for="email_body" class="col-md-4 col-form-label">
						Intervalo de reenvio
					</label>
					<div class="col-md-8">
						<select name="email_rep_interval" class="form-control">
							<option value="nunca">Nunca</option>
							<option value="hora">A cada hora</option>
							<option value="dia">A cada dia</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>