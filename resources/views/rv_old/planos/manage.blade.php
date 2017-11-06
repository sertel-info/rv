@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="/third_party/sweet-alert/css/sweetalert.css">
@endpush

@extends("base.base")

@section("content")

<table id="table-planos" class='table table-bordered table-hover'>
	<thead>
		<th>Nome</th>
		<th>Tipo</th>
		<th>Descrição</th>
		<th>Ações</th>
	</thead>
	<tbody>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tbody>
</table>

@component('layouts.modal')
	@slot('id')
		modal-planos
	@endslot

	@slot('class')
		modal-view
	@endslot

	@slot('body')
		<h1 class='view-title'> </h1>
		<hr>
		<table class='table table-centered'> 
			<thead>
				<th>Item</th>
				<th>Valor</th>
			</thead>
			<tbody>

			</tbody>
		</table>
	@endslot

@endcomponent

@endsection


@push("scripts")

<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
<script type="text/javascript" src="/js/datatables_br.js"></script>
<script type="text/javascript" src="/third_party/sweet-alert/js/sweetalert.min.js"></script>

<script type="text/javascript">
	$(function(){

		var table = $("#table-planos").dataTable({
		          ajax: "{{route('rv.planos.datatables')}}",
		          columns: [
		              {data: "nome",name:"nome"},
		              {data: "tipo", name:"tipo"},
		              {data: "descricao", name:"descricao"},
		              {data: "id_md5", name:"acoes"}
		          ],
		          columnDefs: [
		          {
		            targets:3,
		            render: function(data, meta, type, full){
		              var btnActions = "<a href='{{route('rv.planos.edit')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon-pencil gi-2x'></span>"+
		              				   "</a>";


		              btnActions += "&nbsp&nbsp<a data-id="+data+" data-wrapper='modal-planos' data-action='view' href='{{route('rv.planos.get')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon glyphicon-eye-open gi-2x'></span>"+
		              				   "</a>";

		              btnActions += "&nbsp&nbsp<a data-action='delete' data-id="+data+" data-title='Plano' href='{{route('rv.planos.destroy')}}'>"+
		              				   "<span class='glyphicon glyphicon glyphicon glyphicon-trash gi-2x'></span>"+
		              				   "</a>";

		              return btnActions;
		            }
		          }]
		      });

	});
</script>
<script type="text/javascript" src="/js/delete-alert.js"></script>
<script type="text/javascript" src="/js/view-modal.js"></script>

@endpush