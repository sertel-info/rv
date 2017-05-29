<div class="panel panel-default panel-toggle">
    <div class="panel-heading"  data-toggle="collapse" data-target="#body-geral">
          <h3 class="panel-title"> Configurações Gerais
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
          </h3>
    </div>

	<div class="panel-body " id="body-geral">
            
            <div class="form-group row">
				<label for="pla_nome" class="col-md-4 col-form-label">Prefixo das Aplicações</label>
				<div class="col-md-8">
					{!!Form::text('prefx_aplicacoes', null, ['class'=>'form-control'])!!}
				</div>
			</div>

			<div class="form-group row">
				<label for="pla_nome" class="col-md-4 col-form-label">Atalho Para Siga-Me </label>
				<div class="col-md-8">
					{!!Form::text('atalho_siga_me', null, ['class'=>'form-control'])!!}
				</div>
			</div>

			<div class="form-group row">
				<label for="pla_nome" class="col-md-4 col-form-label">Atalho Para Cadeado</label>
				<div class="col-md-8">
					{!!Form::text('atalho_cadeado', null, ['class'=>'form-control'])!!}
				</div>
			</div>


	</div>	

</div>