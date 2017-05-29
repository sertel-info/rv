@extends("base.base")

@section("content")

<center>

	<h1> Erro  :(</h1>
	<h2> Um erro inesperado ocorreu, por favor tente novamente.</h2>


	<a href="{{ URL::previous() }}" class='btn btn-block btn-warning'> Voltar </a>
</center>
@endsection
