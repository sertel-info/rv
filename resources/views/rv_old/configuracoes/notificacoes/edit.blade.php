@extends("base.base")

@section("content")
    
    <div class="panel panel-default panel-toggle">
    <div class="panel-heading">
          <h3 class="panel-title"> Editar Notificação </h3>
    </div>

    <div class="panel-body">

		<div class="row container-fluid">
		{!! Form::model($notificacao, ['route' => ['rv.configuracoes.notificacoes.update', $notificacao->id_md5], 'method'=>'POST']) !!}               
			
    		@include('rv.configuracoes.notificacoes.formfields_complete')
    		<button class="btn btn-success btn-block"> Salvar </button>
    	
    	{{ Form::close() }}
		</div>

	  </div>
	</div>


@endsection