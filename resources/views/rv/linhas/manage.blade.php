@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="/third_party/sweet-alert/css/sweetalert.css">
@endpush

@extends("base.base")

@section("content")

<table id="table-linhas" class='table table-bordered table-hover'>
	<thead>
		<th>Nome</th>
		<th>Assinante</th>
		<th>Ações</th>
	</thead>
	<tbody>
		<td></td>
		<td></td>
		<td></td>
	</tbody>
</table>

@component('layouts.modal')
	@slot('id')
		modal-linhas
	@endslot

	@slot('class')
		modal-view
	@endslot

	@slot('body')
		<h1 class='view-title'> </h1>
		<hr>
		<table class='table table-centered'> 
			<caption> Dados Básicos </caption>
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

		var table = $("#table-linhas").dataTable({
		          ajax: "{{route('rv.linhas.datatables')}}",
		          columns: [
		              {data: "nome",name:"nome"},
		              {data: "nome_assinante", name:"assinante"},
		              {data: "id_md5", name:"acoes"}
		          ],
		          columnDefs: [
		          {
		            targets:2,
		            render: function(data, meta, type, full){
		              var btnActions = "<a href='{{route('rv.linhas.edit')}}/"+data+"'>"+
		              				   "<span class='glyphicon glyphicon-pencil gi-2x'></span>"+
		              				   "</a>";

		              btnActions += "&nbsp&nbsp<a data-action='delete' data-id="+data+" data-title='Linha' href='{{route('rv.linhas.destroy')}}'>"+
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