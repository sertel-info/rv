@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_wysiwyg/bootstrap3-wysihtml5.min.css">
@endpush

<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Notificação </h3>
    </div>

    <div class="panel-body">

		<div class="form-group">	
			<div class="row">
				<label for="nivel" class="col-md-4 col-form-label">
					Nível
				</label>
				<div class="col-md-8">
					
					{{Form::select('nivel', ['danger'=>'Perigo', 'warning'=>'Aviso', 'success'=>'Sucesso'], null, ['class'=>'form-control'])}}

				</div>
			</div>
		</div>

    	<div class="form-group row">
			<label for="titulo" class="col-md-4 col-form-label">
				Título
			</label>
			<div class="col-md-8">
				{{Form::text('titulo', null, ['class'=>'form-control'])}}
			</div>
		</div>

		<div class="form-group row">
			<label for="mensagem" class="col-md-4 col-form-label">
				Texto
			</label>
			<div class="col-md-8">
				{{Form::text('mensagem', null, ['class'=>'form-control'])}}
			</div>
		</div>
		
	</div>
</div>
   
<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Email </h3>
    </div>

    <div class="panel-body">
		<div class='form-group'>
			<div class="row">
				<label for="ativar_email" class="col-md-4 col-form-label">
					Envio de email
				</label>
				<div class="col-md-8">
					{{Form::checkbox('ativar_email', 1, null, [])}}
				</div>
			</div>
			<div class='collapse'>					
				<div class="row" style="margin-top:15px">
					<label for="assunto_email" class="col-md-4 col-form-label">
						Assunto do email
					</label>
					<div class="col-md-8">
						{{Form::text('email_assunto', null, ['class'=>'form-control'])}}
					</div>
				</div>
				

				<div class="row" style="margin-top:15px">
					<label for="corpo_email" class="col-md-4 col-form-label">
						Texto do Email
					</label>
					<div class="col-md-8">
						<textarea id="editor" name="email_corpo" class='form-control' style="overflow:scroll; max-height:300px"></textarea>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@push("scripts")
<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="/third_party/bootstrap_wysiwyg/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
	$(function(){
		
		$('#editor').wysihtml5();
		
		$("input[name=ativar_email]")
						.on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
							$(this).parents('.form-group:first')
								   .find("div.collapse")
								   .collapse(state ? "show" : "hide");
						});
		
		$("input[name=ativar_email]").bootstrapSwitch({"onText": "Ativo", "offText": "Inativo"});
	})

</script>
@endpush