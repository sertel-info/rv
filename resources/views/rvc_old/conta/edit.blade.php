@extends("base.base")


@section("content")

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Dados da conta</h3>
  </div>
  <div class="panel-body">
  	<div class="container-fluid">

	{!! Form::model($user, ['route' => ['rvc.conta.update', 'u='.md5($user->id)], 'method'=>'PUT', 'id'=>'form-conta']) !!}
		
		@include("rvc.conta.formfields")

	{!! Form::close() !!}
	</div>
	</div>
</div>

@endsection

