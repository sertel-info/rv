@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="/third_party/sweet-alert/css/sweetalert.css">
@endpush

<table id="table-notificacoes" class='table table-responsive table-bordered'>
	<thead>
		<th> Nome </th>
		<th> Mensagem </th>
		<th> Título </th>
		<th> Evento </th>
		<th> Ações </th>
	</thead>
	<tbody>
		
	</tbody>
</table>

@push("scripts")
	<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
	<script type="text/javascript" src="/js/datatables_br.js"></script>
	<script type="text/javascript" src="/third_party/sweet-alert/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="/js/delete-alert.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#table-notificacoes").dataTable({
		        ajax: "{{route('rv.configuracoes.notificacoes.get_data')}}",
		        processing: true,
            	serverSide: true,
            	ordering: false,
		        columns: [
		            {data: "nome", name:"nome"},
		            {data: "mensagem", name:"mensagem"},
		            {data: "titulo",    name:"titulo"},
		            {data: "escutar_evento", name:"escutar_evento"},
		            {data: "id_md5", name:"acoes"},
		        ], 
		        columnDefs : [
		         	{
		          		targets: 4,
		          		render: function(data, meta, full){
		          			var btnActions = "<a href='{{route('rv.configuracoes.notificacoes.edit')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon-pencil gi-2x'></span>"+
		              				   "</a>";

		          			    btnActions += "&nbsp<a data-action='delete' data-id="+data+" data-title='Linha' href='{{route('rv.configuracoes.notificacoes.destroy')}}' data-text='Tem certeza que deseja excluir essa notificação ?'>"+
			              				   "<span class='glyphicon glyphicon glyphicon glyphicon-trash gi-2x'></span>"+
			              				   "</a>";

			              	return btnActions;
		          	 	}
		          	}
		        ]
			});
		})
	</script>

@endpush