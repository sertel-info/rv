<div class='col-md-8 row'>

	<div class='form-group'>
		{{Form::label('name', 'Nome')}}
		{{ Form::text('name', null, ['class'=>'form-control']) }}	
	</div>

	<div class='form-group'>
		{{Form::label('email', 'Email')}}
		{{ Form::text('email', null, ['class'=>'form-control']) }}
	</div>
	
	<div class='form-group'>
		<a href="{{route('rvc.conta.edit_password')}}" class="btn btn-warning" > 
			<span class="glyphicon glyphicon-edit" aria-hidden="true" id="change-password"></span>
 			Alterar a Senha 
 		</a>
	</div>	 
</div>

<button class='btn btn-block btn-success'>
	<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
	Salvar 
</button>

@push("scripts")
	<script type="text/javascript">
		
	</script>
@endpush