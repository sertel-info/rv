@extends('base.base')

@push("headers")
	<link rel="stylesheet" type="text/css" href="/css/file_upload.css">
@endpush

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Editar saudação </h3>
  </div>
  <div class="panel-body">
    
	{{Form::model($saudacao, ['route'=>['rvc.saudacoes.update', 's'=>$saudacao->id_md5], 'method'=>'put', 'id'=>'form-saudacoes', 'enctype'=>'multipart/form-data'])}}
	
		@include("rvc.saudacoes.formfields_edit")
		<br>
		
		<button class="btn btn-block btn-success"> Salvar </button>
	
	{{Form::close()}}

  </div>
</div>

@endsection

@push("scripts")

<script type="text/javascript" src="/js/file_upload.js"></script>

<script type="text/javascript">
	$(function(){
		$("input[name=arquivo_audio]").fileinput({'showUpload':false,
													  'allowedFileTypes':'audio',
													  'showPreview':false,
													  'showRemove':false
													});

	})
</script>

@endpush