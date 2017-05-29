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
				$('input[name=cliente_desde], input[name=dia_vencimento]').mask('00/00/0000');
				$('input[name=limite_credito], input[name=creditos]').mask('###0.00', {reverse: true});
		});
		
		function randomString()
		{
		    var text = "";
		    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		    for( var i=0; i < 8; i++ )
		        text += possible.charAt(Math.floor(Math.random() * possible.length));

		    return text;
		}

		function seedForm(){
			$('input[type=text]').each(function(){
				$(this).val(randomString());
			});
			
			//estado
			$('input[name=estado]').val('RJ');
			//timestamps
			$('input[name=cliente_desde]').val('2017-03-03 10:10:10');
			$('input[name=dia_vencimento]').val('2017-03-03 10:10:10');
			//integers
			$('input[name=dias_bloqueio]').val('2');
			$('input[name=espaco_disco]').val('2');
			//floats
			$('input[name=limite_credito]').val('2.00');
			$('input[name=alerta_saldo]').val('5.00');
		}

	</script>


	
@endpush