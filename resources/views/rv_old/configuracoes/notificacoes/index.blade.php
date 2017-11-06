@extends("base.base")

@section("content")

<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
          <h3 class="panel-title"> Notificações </h3>
    </div>

    <div class="panel-body">

		<div class="row container-fluid">
		      <a href="{{route('rv.configuracoes.notificacoes.create')}}" class="btn btn-success btn-block"> Criar Notificação </a>
		</div>
		<br>
		<div class="row container-fluid">
		      @include("rv.configuracoes.notificacoes.datatables")
		</div>

	  </div>
</div>

@endsection