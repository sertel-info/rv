$(function(){
	//para validar campos escondidos

	$('#form-planos').validate({
			rules: {
				nome: {
				 	required: true
				},
				valor_fixo_local: {
				 	required: true
				},
				valor_sms: {
				 	required: true
				},
				valor_fixo_ddd: {
				 	required: true
				},
				valor_movel_local: {
				 	required: true
				},
				valor_movel_ddd: {
				 	required: true
				},
				valor_ddi: {
				 	required: true
				},
				valor_ip: {
				 	required: true
				}
			},
			
	});
	
})
