@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/media_element/mediaelementplayer.min.css">
@endpush

<div id="upload-file-container" class='form-group' style="display:none">
	<label class='control-label col-md-3'> Arquivo de Áudio: </label>
	<div class='col-md-5'>
		{{Form::file('arquivo_audio', null, ['class'=>'form-control file'])}}
	</div>
</div>

<div class='form-group'  id="audio-preview-container">
	<label class='control-label col-md-3'> Arquivo de Áudio: </label>
	<div class='col-md-5'>
		<audio id="audio-preview-player" class='mejs-player'>
			@if(isset($ura->audio))
				<source src="{{route('rvc.uras.audios.get_blob')}}/{{md5($ura->audio->id)}}" type='audio/wav'/>
			@endif
		</audio>
	</div>
</div>

<div class='form-group'>
	<label class='control-label col-md-3'></label>
	<div class='col-md-5'>
		<a class='btn btn-warning' id="change-audio-file"> 
			<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
	 		Trocar arquivo de áudio
	 	</a>
	 	<a class='btn btn-danger' style="display:none" id="cancel-change-audio-file"> 
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	 		Cancelar
	 	</a>
 	</div>
</div>

@push("scripts")

<script type="text/javascript" src="/third_party/media_element/mediaelement-and-player.min.js"></script>
<script type="text/javascript">
	$(function(){
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
	})
</script>

@endpush