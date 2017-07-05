@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
	<link rel="stylesheet" type="text/css" href="/css/file_upload.css">
	<link rel="stylesheet" type="text/css" href="/third_party/media_element/mediaelementplayer.min.css">
@endpush

<div class='row form-horizontal'>
	
	<div class='form-group'>
		<label class='control-label col-md-3'> Nome: </label>
		<div class='col-md-5'>
			{{Form::text('nome', null, ['class'=>'form-control'])}}
		</div>
	</div>


	<div class='form-group'>
		<label class='control-label col-md-3'> Tipo do Áudio: </label>
		<div class='col-md-5'>
			{{Form::select('tipo_audio', ['obrigatorio'=>'Obrigatório',
									      'opcional'=>'Opcional'], null, ['class'=>'form-control'])}}
		</div>
	</div>

	<div class='form-group'  id="audio-preview-container">
		<label class='control-label col-md-3'> Arquivo de Áudio: </label>
		<div class='col-md-5'>
			<audio id="audio-preview-player" class='mejs-player'>
				<source src="{{route('rvc.saudacoes.audios.get_blob')}}/{{md5($saudacao->audio->id)}}" type='audio/wav'/>
			</audio>
		</div>
	</div>

	<div id="upload-file-container" class='form-group' style="display:none">
		<label class='control-label col-md-3'> Arquivo de Áudio: </label>
		<div class='col-md-5'>
				{{Form::file('arquivo_audio', null, ['class'=>'form-control file'])}}
		</div>
	</div>

	<div class='form-group'>
		<label class='control-label col-md-3'></label>
		<div class='col-md-5'>
			<a class='btn btn-primary' id="change-audio-file"> 
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
	 			Trocar arquivo de áudio
	 		</a>

	 		<a class='btn btn-warning' style="display:none" id="cancel-change-audio-file"> 
				<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
	 			Cancelar
	 		</a>
 		</div>
	</div>
	
</div>

@push("scripts")
	<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/js/file_upload.js"></script>
	<script type="text/javascript" src="/third_party/media_element/mediaelement-and-player.min.js"></script>

	<script type="text/javascript">
		$(function(){
			$("input[name=ativo]").bootstrapSwitch();

			$("input[name=arquivo_audio]").fileinput({'showUpload':false,
													  'allowedFileTypes':'audio',
													  'showPreview':false,
													  'showRemove':false
													});

			$("#change-audio-file").on("click", function(ev){
				var playerId = $('.mejs-container').attr('id');
 					
 				mejs.players[playerId].pause();
				
				$("#upload-file-container").show();
				$("#audio-preview-container").hide();
				$("#cancel-change-audio-file").show();
				$(this).hide();
			});

			$("#cancel-change-audio-file").on("click", function(){
				$("#upload-file-container").hide();
				$("#audio-preview-container").show();
				$("#change-audio-file").show();
				$("input[name=arquivo_audio]").fileinput("clear");

				$(this).hide();
			});
		});

	</script>
@endpush