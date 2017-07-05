
<div class="form-group row">
	<div class='col-md-4 '>
		<center>
				<label for="saudacoes" class=""> Saudações </label> <br>
				{{Form::checkbox('saudacoes', 1, $linha->facilidades->saudacoes or 0, ['class'=>'form-control'])}}
		</center>
	</div>
		
	<div class='col-md-8 collapse'>
		<div class='col-md-6'>
			<label for="saudacoes" class=""> Saudação </label> <br>
			{{Form::select("saudacoes_destino", array(), null, ['class'=>'form-control'])}}
		</div>						
	</div>
</div>


@push("scripts")
	<script type="text/javascript">
		
	    $("input[name=saudacoes]").on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
                  $(this).parents('.form-group:first')
                              .find("div.collapse")
                              .collapse(state ? "show" : "hide");

                              if(state){
                              	 $("select[name=saudacoes_destino]").trigger("rv_option_selected");
                              }
        });
 
        $("select[name=saudacoes_destino]").on("rv_option_selected", function(ev, state){
        	
       		var el = $(this);

			var cache = sessionStorage.getItem('cache_saudacoes');
			var opts = '';

			if(cache){
				var saudacoes = JSON.parse(cache);
						
				for(var i=0; i<saudacoes.length; i++){
					opts += "<option value='"+saudacoes[i].id_md5+"'>"+saudacoes[i].nome+"</option>";
				}

				el.html($(opts));
				el.show();
				el.parent().find("img").remove();
				return;
			}

			$.get("{{route('rvc.saudacoes.get_mine')}}", function(resp){
				resp = JSON.parse(resp);
				var opts = '';
						
				if(resp.length == 0){
						
					opts += "<option value='no'>Nenhuma</option>";
						
				} else {

					for(var i=0; i<resp.length; i++){
						opts += "<option value='"+resp[i].id_md5+"'>"+resp[i].nome+"</option>";
					}
							
					sessionStorage.setItem('cache_saudacoes', JSON.stringify(resp));
				}
						
				el.html($(opts));
				el.show();
				el.parent().find("img").remove();
				el.trigger("rv_finished_changing");
			}) 	
        });

	</script>
@endpush
