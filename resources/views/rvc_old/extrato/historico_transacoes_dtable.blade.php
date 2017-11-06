@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">
@endpush

<table class="table table-bordered table-hover table-striped table-responsive" id="table-hist-transacoes">
	<thead>
		<tr>
			<th>Data</th>
			<th>Hora</th>
			<th>Valor</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
		

@push('scripts')

<script type="text/javascript" src="/third_party/datatables/js/datatables.min.js"></script>
<script type="text/javascript" src="/js/datatables_br.js"></script>

<script type="text/javascript">
	$(function(){
		$("#table-hist-transacoes").dataTable({
		          ajax: {
		          		url: "{{route('rvc.extrato.hist_transacoes.get_mine')}}"
		      	  },
		          processing: true,
            	  serverSide: true,
            	  ordering: false,
            	  searching:false,
            	  pageLength:4,
            	  lengthChange: false,
		          columns: [
		              {data: "date", name:"Data"},
		              {data: "time", name:"Hora"},
		              {data: "value", name:"Value"},
		             
		          ],
		          columnDefs : [
		          {
		          	targets: 2, 
		          	render: function(data){
		          		var floatval = parseFloat(data).toFixed(2);
		          		if(floatval >= 0){
		          			return '<span class="text-success"> +'.concat(floatval, '</span>');
		          		} else if(floatval <= 0){
		          			return '<span class="text-danger"> '.concat(floatval, '</span>');
		          		}
		          		return '<spam class="text-warning">?</span>';
		          	}
		          },

		          ]
		      });
	});
</script>
@endpush