$(function(){
	$('table').on('click','[data-action=delete]', function(ev){
		ev.preventDefault();
		var btn = $(this);
		var title = "Tem Certeza que deseja excluir este(a) "+btn.attr('data-title')+"?";

		if(btn.attr("data-text")){
			title = btn.attr("data-text");
		}
		swal({title: title,
			  type: "warning",   
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Sim",
			  closeOnConfirm: false },
			  function(){ 
				    var data = { id: btn.attr("data-id"),
				  		 	 _token: $("meta[name=_token]").attr('content'),
				  		 	 _method: "delete"};
				    console.log('data', data);
					$.ajax({
					    url: btn.attr('href'),
					    type: 'DELETE',
					    data: data,
					    success: function(resp) {
					        resp = JSON.parse(resp);
					        if(resp.status){
						  		btn.closest("tr").remove();	
								swal("Excluído!", "Agendamento excluído com sucesso.", "success");
						  	} else {
						  		swal("Erro!", "Ocorreu um erro ao excluir, por favor tente novamente.", "error");
						  	}
					    }
					});
			  }
			);
	});
});