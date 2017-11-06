@extends('base.base')

@section('content')
  

<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Pagamaneto Finalizado </h3>
    </div>

    <div class="panel-body"  id="body-grupos">
	    
	    @if($status == "success")
	    	<div class="alert alert-success">
	    		Seu pagamento foi realizado com sucesso !
	    	</div>
	    @elseif($status == "pending")
	    	<div class="alert alert-warning">
	    		Seu pagamento está pendente !
	    	</div>
	    @elseif($status = "failure")
	    	<div class="alert alert-danger">
	    		Ocorreu uma falha ao realizar o pagamento.
	    	</div>
	    @endif

	</div>	
	
</div>

@endsection

@push("scripts")
