<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Notificação </h3>
    </div>

    <div class="panel-body">
    	<div class="form-group row">
			<label for="notification_text" class="col-md-4 col-form-label">
				Nome de identificação
			</label>
			<div class="col-md-8">
				{{Form::text('notification_text', null, ['class'=>'form-control'])}}
			</div>
		</div>

    	<div class="form-group row">
			<label for="notification_text" class="col-md-4 col-form-label">
				Título
			</label>
			<div class="col-md-8">
				{{Form::text('notification_text', null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group row">
			<label for="notification_text" class="col-md-4 col-form-label">
				Texto
			</label>
			<div class="col-md-8">
				{{Form::text('notification_text', null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group">	
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
    