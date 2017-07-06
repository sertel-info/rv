@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="/third_party/sweet-alert/css/sweetalert.css">
@endpush

@extends("base.base")

@section("content")

<table id="table-assinantes" class='table table-bordered table-hover'>
	<thead>
		<th>Nome</th>
		<th>Tipo</th>
		<th>Plano</th>
		<th>Ações</th>
	</thead>
	<tbody>
	</tbody>
</table>

@include('rv.assinantes.modal_view')
@include('rv.assinantes.modal_credits')

@endsection


@push("scripts")

<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
<script type="text/javascript" src="/js/datatables_br.js"></script>
<script type="text/javascript" src="/third_party/sweet-alert/js/sweetalert.min.js"></script>

<script type="text/javascript">
	$(function(){

		var table = $("#table-assinantes").dataTable({
		          ajax: "{{route('rv.assinantes.datatables')}}",
		          columns: [
		              {data: "nome_completo",name:"nome"},
		              {data: "tipo", name:"tipo"},
		              {data: "planos.nome", name:"plano"},
		              {data: "id_md5", name:"acoes"}
		          ],
		          columnDefs: [
		          {
		            targets:3,
		            render: function(data, meta, type, full){
		              var btnActions = "<a href='{{route('rv.assinantes.edit')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon-pencil gi-2x'></span>"+
		              				   "</a>";

		              btnActions += "&nbsp&nbsp<a data-id="+data+" data-wrapper='modal-assinantes' data-action='view' href='{{route('rv.assinantes.get')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon-eye-open gi-2x'></span>"+
		              				   "</a>";

		              /*btnActions += "&nbsp&nbsp<a data-id="+data+" data-wrapper='modal-assinantes' data-action='view' href='#'>"+
		              				   "<span class='glyphicon glyphicon-user gi-2x'></span>"+
		              				   "</a>";*/

		              btnActions += "&nbsp&nbsp<a data-action='delete' data-id="+data+" data-title='Assinante' href='{{route('rv.assinantes.destroy')}}'>"+
		              				   "<span class='glyphicon  glyphicon-trash gi-2x'></span>"+
		              				   "</a>";

		              return btnActions;
		            },
		            createdCell: function(cell, data){

		            	var btnCredits = $('<a href="#" data-id="'+data+'"'+
		              				       "<span class='glyphicon glyphicon-usd gi-2x'></span></a>");

		              	btnCredits.on('click', function(ev){
		              		ev.preventDefault();
		              		var btn = $(this);
		              			id = btn.attr('data-id'),
		              			token = $('meta[name=_token]').attr('content');
		              			
		              		$.get('{{route("rv.assinantes.creditos.get")}}', {u:id}, function(resp){
		              			resp = JSON.parse(resp);
		              			var form = $("#modal-creditos form");

		              			form.find("input[name=u]").val(id);
		              			form.find("input[name=c_add], input[name=c_rmv]").val('');
		              			
		              			$('#curr_credits .h1').html(String(resp.credits)+String(' R$'));
								$('#modal-creditos').modal('show');
		              		});
		              	});

		              	$(cell).append(btnCredits);
		            }

		          }]
		      });

	});

</script>
<script type="text/javascript" src="/js/delete-alert.js"></script>
<script type="text/javascript" src="/js/view-modal.js"></script>

@endpush