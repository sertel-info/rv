@extends("base.base")

@section("content")

<div class="panel panel-default panel-toggle">
    <div class="panel-heading" >
          <h3 class="panel-title"> Configurações Gerais
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
          </h3>
    </div>

	<div class="panel-body ">
		{!! Form::model($configuracoes, ['route' => ['rv.configuracoes.geral.update', $configuracoes->id], 'method'=>'POST', 'id'=>'form-configuracoes']) !!}

		@include('rv.configuracoes.geral.formfields')
		<button class="btn btn-success btn-block">Atualizar </button>

		{!! Form::close() !!}
		@endsection
		
	</div>	

</div>