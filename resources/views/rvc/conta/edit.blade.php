@extends("base.base")


@section("content")

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Editar Conta</h3>
  </div>
  <div class="panel-body">
  
	  <form action="{{route('rvc.conta.update')}}" method="POST" class='form-horizontal'>
	    {{csrf_field()}}
	    
	    <div class='form-group'>
	    	<div class='row'>
	    			<div class='col-md-3'><label class='label-control'> Email</label> </div> 
	    			<div class='col-md-6'> <input type="text" name="email" class='form-control' value="{{isset($user->email) ? $user->email : ''}}"/> </div>
	    	</div>
	    </div>
	    <div class='form-group'>

	    	<div class='row'>
		    	<div class='col-md-3'><label class='label-control'> Senha </label></div>
		    	<div class='col-md-6'><input type="password" name="password" class='form-control'/></div>
	    	</div>
		</div>
	    <div class='form-group'>
	    
	    	<div class='row'>
		    	<div class='col-md-3'><label class='label-control'> Confirmar Senha </label></div>
		    	<div class='col-md-6'><input type="password" name="password_confirmation" class='form-control'/></div>
		    </div>

		</div>
		<button class='btn btn-primary btn-block'> Salvar </button>
	  </form>

 </div>	

  </div>
</div>


@endsection