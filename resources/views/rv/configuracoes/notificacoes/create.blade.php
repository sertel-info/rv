@extends("base.base")

@section("content")
    
    <div class="panel panel-default panel-toggle">
    <div class="panel-heading">
          <h3 class="panel-title"> Configurar Notificação </h3>
    </div>

    <div class="panel-body">

		<div class="row container-fluid">
			<form action="{{route('rv.configuracoes.notificacoes.store')}}" method="POST">
    			@include('rv.configuracoes.notificacoes.formfields_complete')
    			<button class="btn btn-success btn-block"> Salvar </button>
    		</form>
		</div>

	  </div>
	</div>


@endsection