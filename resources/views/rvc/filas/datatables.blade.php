@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="/third_party/sweet-alert/css/sweetalert.css">
@endpush

<div class='row'>
	       		<table id="table-filas" class='table table-bordered table-responsive'>
	       			<thead>
	       				<th>Nome</th>
	       				<th>Tipo</th>
	       				<th>Linhas</th>
	       				<th>Ações</th>
	       			</thead>
	       		</table>
</div>


@push("scripts")
<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
<script type="text/javascript" src="/js/datatables_br.js"></script>
<script type="text/javascript" src="/third_party/sweet-alert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="/js/delete-alert.js"></script>
<script type="text/javascript">
	$(function(){

		var table = $("#table-filas").dataTable({
		          ajax: "{{route('rvc.filas.get')}}",
		          processing: true,
            	  serverSide: true,
            	  ordering: false,
		          columns: [
		              {data: "nome", name:"Nome"},
		              {data: "tipo",    name:"Tipo"},
		              {data: "linhas", name:"Linhas"},
		              {data: "id_md5", name:"Acoes"},
		          ],
		          columnDefs: [
		          	{
		          		targets:2,
		          		render: function(data, meta, full){
		          			var formated_data = "<ul>";

		          			for(var i=0; i<data.length; i++){
		          				formated_data += ("<li>"+data[i].nome+"</li>");
		          			}

		          			formated_data += "</ul>"
		          			return formated_data;
		          		}
		          	},
		          	{
		          		targets:3,
		          		render: function(data,meta,full){
		          			var btnActions = "<a href='{{route('rvc.filas.edit')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon-pencil gi-2x'></span>"+
		              				   "</a>";

			                btnActions += "&nbsp&nbsp<a data-action='delete' data-id="+data+" data-title='Linha' href='{{route('rvc.filas.destroy')}}' data-text='Tem certeza que deseja excluir essa fila ?'>"+
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