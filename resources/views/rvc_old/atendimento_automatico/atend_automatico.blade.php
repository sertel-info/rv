<div class="form-group row">
	<div class='col-md-4 '>
		<center>
				<label for="atend_automatico" class=""> Atendimento automático </label><br>
				{{Form::checkbox('atend_automatico', 1, (isset($linha) && (Boolean)$linha->atend_automatico), ['class'=>'form-control'])}}
		</center>
	</div>
	
	<div class='col-md-8 collapse'>
			
			<div class='col-md-6'>
				<label for="atend_automatico_tipo"> Tipo </label><br>
				
				<select name="atend_automatico_tipo" class='form-control'>
					<option value="0" disabled {{isset($linha) ?: 'selected'}}> Selecione </option> 
					<option value="grupo" {{isset($linha) && $linha->atend_automatico_tipo == "grupo" ? 'selected' : ''}} > Grupo </option>
					<option value="fila" {{isset($linha) && $linha->atend_automatico_tipo == "fila" ? 'selected' : ''}} > Fila </option>
					<option value="ura" {{isset($linha) && $linha->atend_automatico_tipo == "ura" ? 'selected' : ''}} > Ura </option>
				</select>

			</div>
			
			<div class='col-md-6'>
				<label for="atend_automatico_destino"> Alvo </label><br>
				{{Form::select("atend_automatico_destino", [], null, ['class'=>'form-control atend_automatico_destino'])}}
			</div>											
	</div>
</div>

@push("scripts")

<script type="text/javascript">
	
$(function(){

	sessionStorage.clear();
	
	$("select[name=atend_automatico_tipo]").on("change", function(ev){

		ev.preventDefault();

   		var el = $(this);
		var alvo = el.parent().parent().find('input[name=atend_automatico_destino]');
		
		alvo.hide();

	    if(el.val() == 'ura'){
	    	return;
	    }

		if(alvo.parent().find("img").length < 1)
			alvo.parent().append("<img src='/ajax-loader.gif'></img>");
		
				
		if(el.val() !== 'no'){
			alvo.trigger('rv.opt_'+el.val()+'_selected');
		}
		else{
			alvo.html($("<option value='no'>Nenhum</option>"));
		}
	});

	$('select[name=atend_automatico_destino]').on("rv.opt_grupo_selected", function(ev){
		var el = $(this);

		var cache = sessionStorage.getItem('cache_grupos');
		var opts = '';

		if(cache){
			var grupos = JSON.parse(cache);
					
			for(var i=0; i<grupos.length; i++){
				opts += "<option value='"+grupos[i].id_md5+"'>"+grupos[i].nome+"</option>";
			}

			el.html($(opts));
			el.show();
			el.parent().find("img").remove();
			return;
		}

		$.get("{{route('rvc.grupos_atendimento.get_mine')}}/{{$linha->assinante_id}}", function(resp){
			resp = JSON.parse(resp);
			var opts = '';
					
			if(resp.length == 0){
					
				opts += "<option value='no'>Nenhum</option>";
					
			} else {

				for(var i=0; i<resp.length; i++){
					opts += "<option value='"+resp[i].id_md5+"'>"+resp[i].nome+"</option>";
				}
						
				sessionStorage.setItem('cache_grupos', JSON.stringify(resp));
			}
					
			el.html($(opts));
			el.show();
			el.parent().find("img").remove();
		})
	})

	$('select[name=atend_automatico_destino]').on("rv.opt_fila_selected", function(ev){
		var el = $(this);

		var cache = sessionStorage.getItem('cache_filas');
		var opts = '';

		if(cache){
			var filas = JSON.parse(cache);
					
			for(var i=0; i<filas.length; i++){
				opts += "<option value='"+filas[i].id_md5+"'>"+filas[i].nome+"</option>";
			}

			el.html($(opts));
			el.show();
			el.parent().find("img").remove();
			return;
		}

		$.get("{{route('rvc.filas.get_mine')}}/{{$linha->assinante_id}}", function(resp){
			resp = JSON.parse(resp);
			var opts = '';
					
			if(resp.length == 0){
					
				opts += "<option value='no'>Nenhum</option>";
					
			} else {

				for(var i=0; i<resp.length; i++){
					opts += "<option value='"+resp[i].id_md5+"'>"+resp[i].nome+"</option>";
				}
						
				sessionStorage.setItem('cache_filas', JSON.stringify(resp));
			}
					
			el.html($(opts));
			el.show();
			
			el.parent().find("img").remove();
		})
	})

	$('select[name=atend_automatico_destino]').on("rv.opt_ura_selected", function(ev){			
	});

});

</script>

@endpush