<div class="panel panel-default panel-toggle">
    <div class="panel-heading panel-extrato-linha" data-toggle="collapse" data-target="#body-linha-{{$linha->id}}">
        <h3 class="panel-title"> Linha {{$linha->nome}}
	        <div class="collapse-icon pull-right">
	        	<span class="glyphicon glyphicon-circle-arrow-down"> </span>
	        </div>
        </h3>
    </div>
    <div class="panel-body collapse body-panel-extrato-linha" data-id="{{md5($linha->id)}}" id="body-linha-{{$linha->id}}">
                 	
	</div>
</div>

@push('scripts')
	<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
	<script type="text/javascript" src="/js/datatables_br.js"></script>

	<script type="text/javascript">
		
		$(function(){

			$(".panel-extrato-linha").on('click', function(){		
				$(this).parent().find(".panel-body").collapse();

				console.log($(this).parent().find(".panel-body"));
			})

			$(".body-panel-extrato-linha").on('shown.bs.collapse', function(){
				//console.log(data_id);
				//var container = $(this).parent().find('.panel-body');
				var container = $(this),
					data_id = container.attr('data-id');

				//container.html('<center><img src="/ajax-loader.gif" class="loading"/></center>');

			    $.get('{{route("rvc.extrato.linha.get")}}/'+data_id.toString(), function(resp){
			    	//var resp_json = JSON.parse(resp);

			    	/*if(resp_json.status != 1){
			    		console.log('ERRO');
			    		return;
			    	}*/

			   		var table = $("<table style='width:100%' class='table table-bordered table-hover table-striped' id='table-extrato-"+data_id+"'>"+
			   						"<thead>"+
				   						"<th>Origem</th>"+
										"<th>Destino</th>"+
										"<th>Data</th>"+
										"<th>Duração</th>"+
										"<th>Valor</th>"+
									"</thead>"+
			   						"<tbody>"+
			   						"</tbody>"+
			   					  "</table>");

			   		//console.log(resp_json.data);
			   		table.dataTable({
			   			  //data: resp_json.data,
			   			  //ajax: "{{route('rvc.extrato.linha.get')}}",
				          ajax: "{{route('rvc.extrato.linha.get')}}/"+"{{md5($linha->id)}}",
				          processing: true,
            			  serverSide: true,
				          columns: [
				              {data: "src", name:"Origem"},
				              {data: "dst",    name:"Destino"},
				              {data: "start", name:"Start"},
				              {data: "billsec", name:"Billsec"},
				              {data: "cost", name:"Valor"},
				          ],
				          columnDefs : [
				          {
				          	targets: 4, 
				          	render: function(data){
				          		return data.toString().concat(' R$');
				          	}
				          },
				          {
				          	targets: 3, 
				          	render: function(data){
				          		return data.toString().concat(' Seg.');
				          	}
				          }
				          ]
				    });
			   		console.log(table.api());
			   		container.html(table);

			   		table.api().ajax.reload().draw()

			    })
			});
		});
	</script>
@endpush