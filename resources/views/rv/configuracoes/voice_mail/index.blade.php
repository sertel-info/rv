@extends("base.base")

@section("content")

{!! Form::model($configuracoes, ['route' => ['rv.configuracoes.voice_mail.update', $configuracoes->id], 'method'=>'POST', 'id'=>'form-configuracoes']) !!}
	
	<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
          <h3 class="panel-title"> Voice Mail
          	<div class="collapse-icon pull-right">
        		<span class="glyphicon glyphicon-circle-arrow-down"> </span>
       		</div>
          </h3>
    </div>

    <div class="panel-body ">
		@include('rv.configuracoes.voice_mail.formfields')
		<button class="btn btn-success btn-block"> Atualizar </button>
	</div>

</div>

{!! Form::close() !!}
@endsection