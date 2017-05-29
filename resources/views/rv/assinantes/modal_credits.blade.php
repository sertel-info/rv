@component('layouts.modal')
	
	@slot('id') modal-creditos @endslot
	@slot('title') Gerenciar Créditos @endslot

	@slot('body')
	
		<div class='row' id="curr_credits">
			<span class='h2'>Saldo atual:</span>
				<span class='h1' style="color:green"></span>
		</div>

		<div class='row'>
			<div class="col-md-6">			
				<form class="credits-form" action="{{route('rv.assinantes.creditos.update')}}" method="post" swal-title="Adicionar">
					{{csrf_field()}}
					<input type="text" name="o" class="hidden" value="{{md5('mais')}}">
					<input type="text" name="u" class="hidden">
						<div class='alert-success' style="padding:20px">
							<h2> <span class="glyphicon glyphicon-plus gi-1x"></span> Adicionar </h2>
							<div class="form-group form-group-lg">
								<input name="c_add" class='form-control'/>
							</div>
							<div class='row' style='margin-top:10px'>
								<button class="btn btn-block btn-success"> Salvar </button>
							</div>							
						</div>

				</form>
			</div>
			<div class="col-md-6">
				<form class="credits-form" action="{{route('rv.assinantes.creditos.update')}}" method="post" swal-title="Debitar">
					{{csrf_field()}}
					<input type="text" name="o" class="hidden" value="{{md5('menos')}}">
					<input type="text" name="u" class="hidden">
						<div class='alert-danger' style="padding:20px">
							<h2> <span class="glyphicon glyphicon-minus gi-1x"></span> Remover </h2>
							<div class="form-group form-group-lg">
								<input name="c_rmv" class='form-control'/>
							</div>
							<div class='row' style='margin-top:10px'>
								<button class="btn btn-block btn-danger"> Salvar </button>
							</div>	
						</div>			
				</form>
			</div>
		</div>



	@endslot
@endcomponent

@push("scripts")

<script type="text/javascript" src="/third_party/jquery/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('input[name=c_add], input[name=c_rmv]').mask('###0.00', {reverse: true});

		$('#curr_credits').on('rv-change-value', function(ev, value){
			$('#curr_credits .h1').html(String(value)+String(' R$'));
		});
		$('.credits-form').on("submit", function(ev){
			ev.preventDefault();
			var form = $(this),
				data = {
					'o':form.find('input[name=o]').val(),
					'u':form.find('input[name=u]').val(),
					'_token':form.find('input[name=_token]').val(),
					'c_rmv':form.find('input[name=c_rmv]').val(),
					'c_add':form.find('input[name=c_add]').val()
				},
				valor = data.c_rmv || data.c_add;

			form.hide();

			var loading = $('<img src="/ajax-loader.gif"></img>');
			form.after(loading);

			swal({
				  title: 'Confirme !',
				  text: "Tem certeza que "+form.attr('swal-title')+
				  								" R$"+String(parseFloat(valor).toFixed(2))+" deste usuário ?",
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Sim',
				  calcelButtonText: 'Cancelar'
				},function () {
					  $.post(form.attr('action'), data, function(resp){
								resp = JSON.parse(resp);

								if(resp.status == 1){
									form.trigger('rv-success-credits-operation',
												 String(parseFloat(resp.novo_valor).toFixed(2)));
								} else if(resp.status == -1){
									form.trigger('rv-error-removing-value-credits');
								} else {
									form.trigger('rv-generic-error');
								}


								form.show();
								loading.remove();								
					 });
				})
			
		});

		$('.credits-form').on('rv-success-credits-operation', function(ev, novo_valor){
			$('#curr_credits').trigger('rv-change-value', novo_valor);

			swal(
				  'Sucesso',
				  'Créditos atualizados com sucesso',
				  'success'
				)
		});

		$('.credits-form').on('rv-generic-error', function(ev){
			swal(
				  'Ops !',
				  'Um erro inesperado ocorreu, tente novamente.',
				  'error'
				)
		});	

		$('.credits-form').on('rv-error-removing-value-credits', function(ev){
			swal(
				  'Ops !',
				  'Não é possível remover este valor',
				  'error'
				)
		});		


		

	})
</script>
@endpush("scripts")