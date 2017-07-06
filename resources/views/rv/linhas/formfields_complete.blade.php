@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
	<link rel="stylesheet" type="text/css" href="/css/picklist.css">
@endpush
   
<form method="POST" action="#">
	@include("rv.linhas.formfields.dados_basicos")
	@include("rv.linhas.formfields.autenticacao")
	@include("rv.linhas.formfields.did")
	@include("rv.linhas.formfields.codecs")
	@include("rv.linhas.formfields.troncos")
	@include("rv.linhas.formfields.configuracoes_gerais")
	@include("rv.linhas.formfields.facilidades")
	@include("rv.linhas.formfields.permissoes")
 
	<button class='btn btn-success btn-block'> Salvar </button>
</form>

@push("scripts")
	<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/third_party/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/js/picklist.js"></script>
	<script type="text/javascript" src="/js/validator-defaults.js"></script>
    <script type="text/javascript" src="/js/validate-linha.js"></script>
    <script type="text/javascript" src="/third_party/jquery/jquery.mask.min.js"></script>

	<script type="text/javascript">
		$(function(){
			
			$("input[name=cadeado_pessoal], input[name=caixa_postal], input[name=siga_me], input[name=atend_automatico]")
						.on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
							$(this).parents('.form-group:first')
								   .find("div.collapse")
								   .collapse(state ? "show" : "hide");
						});


			$("input[name=status_did]").on('init.bootstrapSwitch switchChange.bootstrapSwitch', function(ev, state){
				$('#form-did').collapse(state ? 'show' : 'hide');
			});

						
			$("input[type=checkbox]").not("[name=status]").bootstrapSwitch();

			$("input[name=status]").bootstrapSwitch({"onText": "Ativo", "offText": "Inativo"});

			$("#form-linhas").on("submit", function(ev){
				$(".pickListResult option").prop("selected", true);
			});

			$("select[name=atend_automatico_tipo]").trigger('change');
			
			@if(isset($linha->facilidades))
				$("select[name=atend_automatico_destino]").on("rv_finished_changing", function(){
      				$(this).val("{{ $linha->facilidades->atend_automatico_destino }}").trigger("change");
				});
			@endif
		})
	</script>

@endpush