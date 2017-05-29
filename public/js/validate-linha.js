$(function(){
	//para validar campos escondidos

	$('#form-linhas').validate({
			rules: {
				nome: {
				 	required: true
				},
				ddd_local: {
				 	minlength: 2
				},
				login_ata: {
				 	required: true
				},
				usuario: {
				 	required: true,
				 	number:true
				},
				senha: {
				 	required: true
				},
				porta: {
					minlength: 2
				},
				assinante_id: {
					required: true
				},
				cadeado_pin: {
				 	required: "input[name=cadeado_pessoal]:checked"
				},
				cx_postal_pw: {
				 	required: "input[name=caixa_postal]:checked"
				},
				num_siga_me: {
				 	required: "input[name=siga_me]:checked"
				},
				usuario_did: {
				 	required: "input[name=status_did]:checked"
				},
				senha_did: {
				 	required: "input[name=status_did]:checked"
				},
				extensao_did: {
				 	required: "input[name=status_did]:checked"
				},
				ip_did: {
				 	required: "input[name=status_did]:checked"
				}
			},
			
	});
	
})
