@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
	<link rel="stylesheet" type="text/css" href="/css/file_upload.css">
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

	<div id="upload-file-container" class='form-group'>
		<label class='control-label col-md-3'> Arquivo de Áudio: </label>
		<div class='col-md-5'>
			{{Form::file('arquivo_audio', null, ['class'=>'form-control file'])}}
		</div>
	</div>

</div>

@push("scripts")
	<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="/js/file_upload.js"></script>

	<script type="text/javascript">
		$(function(){
			$("input[name=ativo]").bootstrapSwitch();

			$("input[name=arquivo_audio]").fileinput({'showUpload':false,
													  'allowedFileTypes':'audio',
													  'showPreview':false,
													  'showRemove':false
													});
		});

	</script>
@endpush