@push('headers')

@endpush

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Extrato</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered table-hover table-striped" id="table-extrato">
	    <thead>
	        <tr>
	            <th>Origem</th>
	            <th>Destino</th>
	            <th>Data</th>
	            <th>Duração</th>
	            <th>Valor</th>
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
		$("#table-extrato").dataTable({
		          ajax: "{{route('rvc.extrato.linha.get')}}/{{md5($linha->id)}}",
		          processing: true,
            	  serverSide: true,
            	  ordering: false,
            	  "dom": '<"row" <"col-md-6"l><"col-md-6"f>>rt <"row"<"col-sm-5"i><"col-sm-7"p>>',
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
	});
</script>
@endpush