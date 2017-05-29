$(function(){
	//para validar campos escondidos

	$('#form-assinantes').validate({
			rules: {
				cnpj: {
				 	required: "input[name=tipo]:not(:checked)"
				},
				cpf: {
				 	required: "input[name=tipo]:checked"
				},
				dias_bloqueio: {
				 	required: true
				},
				dia_vencimento: {
				 	required: true
				},
				limite_credito: {
				 	required: true
				},
				usuario: {
				 	required: true
				},
				senha: {
				 	required: true
				},
				plano: {
					required: true
				}

			},
			
	});
	
})
