@extends('base.base')

@section('content')
  <form method="POST" id="form-filas" action="{{route('rvc.filas.store')}}">
	   {{csrf_field()}}
	   @include("rvc.filas.formfields")
     <br>
     <button class='btn btn-success btn-block'> Salvar </button>
  </form>
@endsection

