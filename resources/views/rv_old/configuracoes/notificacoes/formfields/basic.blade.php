<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Notificação </h3>
    </div>

    <div class="panel-body">
    	<div class="form-group row">
			<label for="name" class="col-md-4 col-form-label">
				Nome de identificação
			</label>
			<div class="col-md-8">
				{{Form::text('nome', null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group">	
			<div class="row">
				<label for="escutar_evento" class="col-md-4 col-form-label">
					Status
				</label>
				<div class="col-md-8">
					{{Form::checkbox('status', 1, null, [])}}
				</div>
			</div>
		</div>

		<div class="form-group">	
			<div class="row">
				<label for="escutar_evento" class="col-md-4 col-form-label">
					Evento
				</label>
				<div class="col-md-8">
						{{Form::select('escutar_evento', ['none'=>'Nenhum', 'CreditosAcabando'=>'Créditos Acabando', 'CreditosRemovidos'=>'Créditos Removidos', 'CreditosAdicionados'=>'Créditos Adicionados'], null, ['class'=>'form-control'])}}
				</div>
			</div>
		</div>	

		<div class="form-group">	
			<div class="row">
				<label for="nivel" class="col-md-4 col-form-label">
					Nível
				</label>
				<div class="col-md-8">
					
					{{Form::select('nivel', ['danger'=>'Perigo', 'warning'=>'Aviso', 'success'=>'Sucesso'], null, ['class'=>'form-control'])}}

				</div>
			</div>
		</div>

    	<div class="form-group row">
			<label for="titulo" class="col-md-4 col-form-label">
				Título
			</label>
			<div class="col-md-8">
				{{Form::text('titulo', null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group row">
			<label for="mensagem" class="col-md-4 col-form-label">
				Texto
			</label>
			<div class="col-md-8">
				{{Form::text('mensagem', null, ['class'=>'form-control'])}}
			</div>
		</div>
		
		<!-- <div class="form-group">	
			<div class="row">
				<label for="numero_envios" class="col-md-4 col-form-label">
					Número de envios
				</label>
				<div class="col-md-8">
					{{Form::text('numero_envios', null, ['class'=>'form-control'])}}
				</div>
			</div>
		</div>	 -->

		<!--<div class="form-group">	
			<div class="row">
				<label for="intervalo_reenvio" class="col-md-4 col-form-label">
					Intervalo de reenvio
				</label>
				<div class="col-md-8">
					
					{{Form::select('intervalo_reenvio', ['nunca'=>'Nunca', 'hora'=>'A cada hora', 'dia'=>'A cada dia'], null, ['class'=>'form-control'])}}
					
				</div>
			</div>
		</div> -->


	</div>
</div>
    