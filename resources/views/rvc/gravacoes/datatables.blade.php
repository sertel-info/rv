@push('headers')

@endpush

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Gravações</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered table-hover table-striped" id="table-correio-voz">
	    <thead>
	        <tr>
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
		table = $("#table-correio-voz").dataTable({
		          ajax: "{{route('rvc.gravacoes.get')}}",
		          rowId: 'id_md5',
		          columns: [
		              {data: "callerid", name:"Origem"},
		              {data: "exten",    name:"Destino"},
		              {data: "data", name:"Data"},
		              {data: "duration", name:"Duration"},
		              {data: "id", name:"acoes"}
		          ],
		          columnDefs: [
		          
		          {
		            targets:4,
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