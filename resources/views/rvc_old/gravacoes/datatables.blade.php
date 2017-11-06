@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
@endpush

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Gravações</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered table-hover table-striped" id="table-gravacoes">
	    <thead>
	        <tr>
	            <th>Origem</th>
	            <th>Destino</th>
	            <th>Data</th>
	            <th>Hora</th>
	            <th>Duração</th>
	            <th>Ações</th>
	        </tr>
	    </thead>
	    <tbody>
	    </tbody>
	</table>
  </div>
</div>


@push('scripts')

<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
<script type="text/javascript" src="/js/datatables_br.js"></script>

<script type="text/javascript">
	$(function(){
		var table = $("#table-gravacoes").dataTable({
		           ajax: {
		          		url: "{{route('rvc.gravacoes.get')}}",
		          		data: function(data){
				          	data.filters = {
				          		tipo_chamada : $("select[name='tipo_chamada']").val(),
				          		tipo_destino : $("select[name='tipo_destino']").val(),
				          		origem : $("input[name='origem']").val(),
				          		destino : $("input[name='destino']").val(),
				          		data_min : $("input[name='data_min']").val(),
				          		data_max : $("input[name='data_max']").val(),
				          		hora_min : $("input[name='hora_min']").val(),
				          		hora_max : $("input[name='hora_max']").val(),
				          		duracao_min : $("input[name='duracao_min']").val(),
				          		duracao_max : $("input[name='duracao_max']").val()
				          	};
				        }
		      	  },
		          rowId: 'id_md5',
		          ordering: false,
		          serverSide:true,
		          processing:true,
		          columns: [
		              {data: "callerid", name:"Origem"},
		              {data: "destino",    name:"Destino"},
		              {data: "date", name:"Data"},
		              {data: "time", name:"Data"},
		              {data: "duration", name:"Duration"},
		              {data: "id", name:"acoes"}
		          ],
		          columnDefs: [
		          {
		          	targets: 0, 
		          	render: function(data){
		          		data = data.replace(/^[0]/, "");
		          		if(data.length >= 10 && data.length <= 14){
		          			//return data;
		          			
		          			var num_arr = data.match(/^(00|0|9090|90|55)?(([0-9]{2})?([0-9]{2}))?(([0-9])[0-9]{7,})(\s.*)?/);

		          			var ddd = num_arr[4] !== undefined ? "("+num_arr[4].toString()+")" : "";
		          			
		          			if(num_arr[5]){
		          				var num = num_arr[5];
		          				num = num.replace(/^([0-9]{4,5})([0-9]{4})$/, "$1-$2");
		          			} else {
		          				num = data;
		          			}
		          			
		          			return ddd.concat(' ',num);

		          		}

		          		return data;
		          	}
		          },
		          {
		          	targets: 1, 
		          	render: function(data){
		          		data = data.replace(/^[0]/, "");
		          		if(data.length >= 8 && data.length <= 25){
		          			//return data;
		          			
		          			var num_arr = data.match(/^(00|0|9090|90|55)?(([0-9]{2})?([0-9]{2}))?(([0-9])[0-9]{7,})(\s.*)?/);

		          			var ddd = num_arr[4] !== undefined ? "("+num_arr[4].toString()+")" : "";
		          			
		          			if(num_arr[5]){
		          				var num = num_arr[5];
		          				var resto = num_arr[7] !== undefined ? num_arr[7] : "";  
		          				num = num.replace(/^([0-9]{4,5})([0-9]{4})$/, "$1-$2");
		          			} else {
		          				var resto = "";
		          				num = data;
		          			}
		          			
		          			return ddd.concat(' ',num, resto);

		          		}

		          		return data;
		          	}
		          },
		          {
		            targets:5,
		            "createdCell": function (td, cellData, rowData, row, col) {
				      var id = String(cellData),
				      	  listenBtn = $('<a href="" class="" >'+
		               					'<span class="glyphicon glyphicon-headphones gi-2x">'+
		               					'</span> </a> &nbsp');

				       listenBtn.on("click", function(ev){
				      		ev.preventDefault();

				      		var audio = $('#player-container audio'),
				                playerId = audio.closest('.mejs-container').attr('id'),
				                player = mejs.players[playerId],
				                player_container = $('#player-container');
				        	
				        	player_container.find('.mejs-container')	
				      					    .hide();

				      		player_container.append('<img src="/ajax-loader.gif" class="loading"/>');
				      							  
				            player.setSrc("{{route('rvc.gravacoes.get_blob')}}/"+rowData.unique_id);
				            
			            	player.load();
				      });

				      var data = 'f='+rowData.unique_id;
		              var downloadBtn = $('<a href="{{route("rvc.gravacoes.download")}}?'+data+'" class="" download>'+
		               					'<span class="glyphicon glyphicon-download-alt gi-2x">'+
		               					'</span> </a> &nbsp');


		              downloadBtn.on("click", function(ev){
		              	ev.preventDefault();
		              	
		              	var file_url = $(this).attr("href");

		              	$.ajax({
		              		url:file_url,
		              		success:function(){
		              			window.location = file_url;
		              		},
		              		error: function(xhr){
		              			if(xhr.status !== 200)
		              				$.toaster({
		              					priority: "danger",
		              					message: "Um erro inesperado ocorreu, Tente novamente",
		              					title: "Atenção"
		              				});
		              		}
		              	});
		              });


				      $(td).append(downloadBtn, listenBtn);
				    },
				    render(){
				    	return '';
				    }

		          }]
		      });
	});
</script>
@endpush