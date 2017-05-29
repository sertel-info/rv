

@include('rvc.config.formfields.facilidades')


@push("scripts")
 <script type="text/javascript">
 	$(function(){
 		$("input[name=cadeado_pessoal], input[name=caixa_postal], input[name=siga_me]")
                                                .on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
                                                        $(this).parents('.form-group:first')
                                                                   .find("div.collapse")
                                                                   .collapse(state ? "show" : "hide");
                                                });
 	});
 </script>
@endpush