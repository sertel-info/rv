<div class='row form-horizontal'>
	
	<div class='form-group'>
		<label class='control-label col-md-3'> Tipo do Áudio: </label>
		<div class='col-md-5'>
			{{Form::select('tipo_audio', ['obrigatorio'=>'Obrigatório',
									      'opcional'=>'Opcional'], null, ['class'=>'form-control'])}}
		</div>
	</div>

@if($ura !== null)
	@include('rvc.ura.upload_file_edit')
@else 
	@include('rvc.ura.upload_file')
@endif

</div>

<br>

@include("rvc.ura.form_digitos_uras")

@push("scripts")
	<script type="text/javascript" src="/js/file_upload.js"></script>
	<script type="text/javascript">
		$(function(){
			sessionStorage.clear();
			
			$("input[name=arquivo_audio]").fileinput({'showUpload':false,
													  'allowedFileTypes':'audio',
													  'showPreview':false,
													  'showRemove':false
													});


		
			$(".select_tipo").on("change", function(ev){
				ev.preventDefault();
				var el = $(this);
				var select_destino = el.parents('tr').find(".select_destino");
				
				if(el.val() !== '0'){
					select_destino.trigger('rv.opt_'+el.val()+'_selected');
				}
				else{
					select_destino.html($("<option value='0'>Nenhum</option>"));
				}
			});

			$('.select_destino').on("rv.opt_ramal_selected", function(ev){
				var el = $(this);

				var cache = sessionStorage.getItem('cache_ramais');
				var opts = '';

				if(cache){
					var ramais = JSON.parse(cache);
					
					for(var i=0; i<ramais.length; i++){
						opts += "<option value='"+ramais[i].id_md5+"'>"+ramais[i].nome+"</option>";
					}

					el.html($(opts));
					return;
				}

				$.get("{{route('rvc.get.linhas')}}", function(resp){
					resp = JSON.parse(resp);
					var opts = '';
					
					if(resp.length == 0){
					
						opts += "<option value='0'>Nenhum</option>";
					
					} else {

						for(var i=0; i<resp.length; i++){
							opts += "<option value='"+resp[i].id_md5+"'>"+resp[i].nome+"</option>";
						}
						
						sessionStorage.setItem('cache_ramais', JSON.stringify(resp));
					}
					

					el.html($(opts));
				})
			})

			$('.select_destino').on("rv.opt_grupo_selected", function(ev){
				var el = $(this);

				var cache = sessionStorage.getItem('cache_grupos');
				
				if(cache){
					var grupos = JSON.parse(cache);
					var opts = '';
					
					for(var i=0; i<grupos.length; i++){
						opts += "<option value='"+grupos[i].id_md5+"'>"+grupos[i].nome+"</option>";
					}

					el.html($(opts));
					return;
				}

				$.get("{{route('rvc.grupos_atendimento.get_mine')}}", function(resp){
					resp = JSON.parse(resp);

					var opts = "";

					if(resp.length == 0){
					
						opts += "<option value='0'>Nenhum</option>";
					
					} else {
						
						for(var i=0; i<resp.length; i++){
							opts += "<option value='"+resp[i].id_md5+"'>"+resp[i].nome+"</option>";
						}
						
						sessionStorage.setItem('cache_grupos', JSON.stringify(resp));

					}


					el.html($(opts));
				})
			})

			$('.select_destino').on("rv.opt_fila_selected", function(ev){
				var el = $(this);
				var cache = sessionStorage.getItem('cache_filas');
				
				if(cache){
					var fila = JSON.parse(cache);
					var opts = '';
					
					for(var i=0; i<fila.length; i++){
						opts += "<option value='"+fila[i].id_md5+"'>"+fila[i].nome+"</option>";
					}

					el.html($(opts));
					return;
				}

				$.get("{{route('rvc.filas.get_mine')}}", function(resp){
					resp = JSON.parse(resp);
					console.log(resp);
					var opts = "";

					if(resp.length == 0){
					
						opts += "<option value='0'>Nenhum</option>";
					
					} else {
						
						for(var i=0; i<resp.length; i++){
							opts += "<option value='"+resp[i].id_md5+"'>"+resp[i].nome+"</option>";
						}
						
						sessionStorage.setItem('cache_filas', JSON.stringify(resp));
					}

					el.html($(opts));
				})
			})

	  })
	</script>
@endpush