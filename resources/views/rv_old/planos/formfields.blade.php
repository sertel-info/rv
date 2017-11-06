
{{csrf_field()}}

<div class="panel panel-default panel-toggle">
    <div class="panel-heading"  >
          <h3 class="panel-title"> Dados do Plano <u> {{$plano->nome or ''}} </u>
 
          </h3>
    </div>
    <div class="panel-body " id="body-acesso">
                    <div class="form-group row">
						<label for="pla_nome" class="col-md-4 col-form-label">Nome</label>
						<div class="col-md-8">
						   {!!Form::text('nome', null, ['class'=>'form-control'])!!}
						</div>
					</div>

					<div class="form-group row">
						<label for="pla_tipo" class="col-md-4 col-form-label"> Tipo do Plano  </label>
						<div class="col-md-8">

						   {{Form::select('tipo', ['pre'=>'PRÉ PAGO', 'pos'=>'PÓS PAGO'], null, ['class'=>'form-control'])}}
						
						</div>
					</div>

					<div class="form-group row">
						<label for="pla_val_sms" class="col-md-4 col-form-label "> Valor do SMS  </label>
						<div class="col-md-8">
						   	
						   	{{Form::text("valor_sms", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>

					<div class="form-group row">
						<label for="pla_val_fx_lc" class="col-md-4 col-form-label "> Valor para fixo local  </label>
						<div class="col-md-8">
						   {{Form::text("valor_fixo_local", null, ['class'=>'form-control money-val'])}}
						</div>
					</div>

					<div class="form-group row">
						<label for="pla_val_fixo_ddd" class="col-md-4 col-form-label "> Valor para fixo DDD </label>
						<div class="col-md-8">
						  {{Form::text("valor_fixo_ddd", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>

					<div class="form-group row">
						<label for="pla_val_mv_lc" class="col-md-4 col-form-label "> Valor para móvel local  </label>
						<div class="col-md-8">

						{{Form::text("valor_movel_local", null, ['class'=>'form-control money-val'])}}
						
						</div>

					</div>

					<div class="form-group row">
						<label for="pla_val_mv_ddd" class="col-md-4 col-form-label "> Valor para móvel DDD </label>
						<div class="col-md-8">
						
						{{Form::text("valor_movel_ddd", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>

                    <div class="form-group row">
						<label for="pla_val_ddi" class="col-md-4 col-form-label "> Valor para DDI  </label>
						<div class="col-md-8">
						   	
						   	{{Form::text("valor_ddi", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>

					<div class="form-group row">
						<label for="pla_val_ip" class="col-md-4 col-form-label "> Valor para IP  </label>
						<div class="col-md-8">
						   	
						   	{{Form::text("valor_ip", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>


					<div class="form-group row">
						<label for="pla_val_ip" class="col-md-4 col-form-label "> Valor Fixo Entrante  </label>
						<div class="col-md-8">
						   	
						   	{{Form::text("valor_fixo_entrante", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>

					<div class="form-group row">
						<label for="pla_val_ip" class="col-md-4 col-form-label "> Valor Móvel Entrante  </label>
						<div class="col-md-8">
						   	
						   	{{Form::text("valor_movel_entrante", null, ['class'=>'form-control money-val'])}}

						</div>
					</div>

					<div class="form-group row">
						<label for="pla_descricao" class="col-md-4 col-form-label"> Descrição  </label>
						<div class="col-md-8">
						    
						    {{Form::textarea("descricao", null, ['class'=>'form-control money-val', 'style'=>'height:80px;'])}}
						   
						</div>
					</div>

					<button class='btn btn-success btn-block'> Salvar </button>

	</div>

</div>


@push("scripts")
	<script type="text/javascript" src="/third_party/jquery/jquery.maskMoney.min.js"> </script>
	<script type="text/javascript" src="/third_party/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/js/validator-defaults.js"></script>
	<script type="text/javascript" src="/js/validate-planos.js"></script>
		<script type="text/javascript" src="/third_party/jquery/jquery.mask.min.js"></script>


	<script type="text/javascript">
		$(function(){

			$('.money-val').mask('###0.00', {reverse: true});

		});
	</script>	
@endpush