$(function(){
	$('table').on('click','[data-action=view]', function(ev){
		ev.preventDefault();
		var btn = $(this);
		var $wrapper = $('#'+btn.attr("data-wrapper"));
		var $table = $wrapper.find('table').first();

		$table.parent().find("img").remove();
		$table.hide().before("<img src='/ajax-loader.gif'></img>");
		$wrapper.modal('show');

		$.get(btn.attr("href"), {"id":btn.attr("data-id")}, function(resp){
			resp = JSON.parse(resp);

			var not_to_print = ['id',
							    'created_at',
							    'updated_at', 
							    'assinante_id', 
							    'linha_id', 
							    'id_md5',
							    'table_name'];


			$wrapper.find('.view-title')
					.html(resp.Nome);

			for(var field in resp){
				if(not_to_print.indexOf(field) >= 0){
					continue;
				}
				var campo = resp[field];
				if(typeof campo == 'object' && campo != null){

					var $last_table = $table.parent().find('table').last();

				    var $new_table = $('<table class="table table-centered">'+
				    					'<caption>'+campo.table_name+'</caption>'+
				    					'<thead><th>Item</th><th>Valor</th></thead>'+
				    					'<tbody></tbody></table>')
				    				  .insertAfter($last_table);

					for(var att in campo){
						if(not_to_print.indexOf(att) >= 0){
							continue;
						}
						var att_formatado = att.charAt(0).toUpperCase() + att.slice(1).replace("_", " ");
				        $new_table.append("<tr><td>"+att_formatado+"</td><td>"+(campo[att] != null ? campo[att] : '-')+"</td></tr>")
					}
				} else {
					var att_formatado = field.charAt(0).toUpperCase() + field.slice(1).replace("_", " ");
				    $table.append("<tr><td>"+att_formatado+"</td><td>"+(campo != null ? campo : '-')+"</td></tr>")
				}
				
			}

			$wrapper.find("img").remove();
			$table.show();

		});
	});

	$('.modal-view').on('hidden.bs.modal', function(){

		$(this).find('.view-title')
				.empty()
				.end()
				.find('table:first tbody')
				.empty()
				.end()
				.find('table:not(:first)')
				.remove()
	});
});