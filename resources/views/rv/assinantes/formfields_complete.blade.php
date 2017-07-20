@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
@endpush
 
	{{csrf_field()}}
	@include("rv.assinantes.formfields.dados_basicos")
	@include("rv.assinantes.formfields.contato")
	@include("rv.assinantes.formfields.financeiro")
	@include("rv.assinantes.formfields.facilidades")
	@include("rv.assinantes.formfields.dados_acesso")

	<button class='btn btn-success btn-block'> Salvar </button>


@push("scripts")
	<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/third_party/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/js/validator-defaults.js"></script>
	<script type="text/javascript" src="/js/validate-assinante.js"></script>
	<script type="text/javascript" src="/third_party/jquery/jquery.mask.min.js"></script>

	<script type="text/javascript">
		$(function(){
			$("input[type=checkbox]").not("[name=tipo]").bootstrapSwitch();

			$("input[name=tipo]").on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
									 	
									 if(state){
									 	 	$("form [data-type=fis]").show();
									 	 	$("form [data-type=jur]").hide();
									 	 	return;
									 	 }
									 	 $("form [data-type=fis]").hide();
									 	 $("form [data-type=jur]").show();
									 })
								 .bootstrapSwitch({"offText":'Pessoa Jurídica',
													   "onText": 'Pessoa Física',
													   "onColor": 'primary',
													   "offColor": 'warning'})

				$('input[name=cnpj]').mask('00.000.000/0000-00', {reverse: true});
				$('input[name=cpf]').mask('000.000.000-00', {reverse: true});
				$('input[name=dia_vencimento]').mask('00');
				$('input[name=alerta_saldo]').mask('000.000.000.000.000,00 R$', {reverse: true});
				$('input[name=espaco_disco]').mask('0000 GB', {reverse: true});
		});
		

	</script>


	
@endpush