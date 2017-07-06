@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
@endpush

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Caixa de entrada</h3>
  </div>
  <div class="panel-body">
	<table class="table table-bordered table-hover table-striped" id="table-correio-voz">
	    <thead>
	        <tr>
	            <th>Id</th>
	            <th>Origem</th>
	            <th>Destino</th>
	            <th>Data</th>
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
		$("#table-correio-voz").dataTable({
		          ajax: "{{route('rvc.correio_voz.get')}}",
		          columns: [
		              {data: "id", name:"Id"},
		              {data: "callerid", name:"Origem"},
		              {data: "ramal",    name:"Destino"},
		              {data: "origdate", name:"Data"},
		              {data: "duration", name:"Data"},
		              {data: "id", name:"acoes"}
		          ],
		          columnDefs: [
		          
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
				      							  
				            player.setSrc("{{route('rvc.correio_voz.get_blob')}}/"+
				            					String(rowData.exten)+'/'+
				            					id);
				            player.load();

				      });

				      var data = 'f='+id+"&r="+String(rowData.ramal);
		              var downloadBtn = $('<a href="{{route("rvc.correio_voz.download")}}?'+data+'" class="" download>'+
		               					'<span class="glyphicon glyphicon-download-alt gi-2x">'+
		               					'</span> </a> &nbsp');

				      $(td).append(downloadBtn, listenBtn);
				    },
				    "render":function(){
				    	return '';
				    }

		          }]
		      });
	});
</script>

@endpush