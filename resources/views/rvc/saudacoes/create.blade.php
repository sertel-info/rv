@extends('base.base')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"> Criar saudação </h3>
  </div>
  <div class="panel-body">
    
    <form action="{{route('rvc.saudacoes.store')}}" enctype="multipart/form-data" method="post">
		@include("rvc.saudacoes.formfields")
		<br>
		{{ csrf_field() }}
		<button class="btn btn-block btn-success"> Salvar </button>
	</form>

  </div>
</div>

@endsection
