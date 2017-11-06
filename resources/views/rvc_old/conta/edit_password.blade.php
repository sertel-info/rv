@extends("base.base")


@section("content")

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Alterar Senha </h3>
  </div>
  <div class="panel-body">
  	<div class="container-fluid">

	{!! Form::open(["route" => 'rvc.conta.update_password', "method" => "put"]) !!}
		<div class='col-md-5 row'>

			<div class='form-group'>
				{{ Form::label('password_old', 'Senha antiga') }}
				{{ Form::password('password_old', ['class'=>'form-control']) }}	
			</div>

			<div class='form-group'>
				{{ Form::label('password', 'Nova senha') }}
				{{ Form::password('password', ['class'=>'form-control']) }}	
			</div>

			<div class='form-group'>
				{{ Form::label('password_confirmation', 'Confirmar senha') }}
				{{ Form::password('password_confirmation', ['class'=>'form-control']) }}
			</div>

		</div>
			
		<button class="btn btn-block btn-success"> <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Salvar </button>
		
		<a href="{{URL::previous()}}" class='btn btn-block btn-default'>
			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> 
			Voltar 
		</a>

	{!! Form::close() !!}
	</div>
  </div>
</div>
@endsection
