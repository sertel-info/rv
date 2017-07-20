@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
@endpush
    
	@include("rv.configuracoes.notificacoes.formfields.basic")
	@include("rv.configuracoes.notificacoes.formfields.email")

@push("scripts")
<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
	$(function(){
		
		$("input[name=active_email]")
						.on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
							$(this).parents('.form-group:first')
								   .find("div.collapse")
								   .collapse(state ? "show" : "hide");
						});
		
		$("input[name=active_email]").bootstrapSwitch({"onText": "Ativo", "offText": "Inativo"});
	})

</script>
@endpush