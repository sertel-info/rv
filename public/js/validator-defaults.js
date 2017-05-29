$.validator.setDefaults({ 
    	ignore: "",
    	errorElement: 'p',
		errorClass: 'text-danger',
		errorPlacement: function(error, element) {
				  if(element.parent('.form-group').length) {
				      error.insertAfter(element.parent());
				  } else {
				      error.insertAfter(element);
				  }
		},
		highlight: function(element) {
		        $(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
		        $(element).closest('.form-group').removeClass('has-error');
		},
		invalidHandler: function(form, validator){
			for(field in validator.invalid){
				var panel = $('input[name='+field+']').parents(".panel-body").first();
				console.log(panel.hasClass("collapse"), panel.hasClass("in"));
				if(panel.hasClass("collapse") && !panel.hasClass("in")){
						panel.collapse("show");
				}
			}
		},
		messages : {
			minlength: jQuery.validator.format("Este campo deve ter no mínimo {0} dígitos")
		}
	});