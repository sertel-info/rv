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
		          ajax: {url:"{{route('rvc.extrato.linhas.get')}}/{{md5($linha->id)}}",
		      			 data: function(data){
		      			 	data.filters = {
		      			 		origem: $("input[name=origem]").val(),
			      			 	destino :$("input[name=destino]").val(),
			      			 	data_min : $("input[name=data_min]").val(),
			      			 	data_max :$("input[name=data_max]").val(),
			      			 	duracao_min: $("input[name=duracao_min]").val(),
			      			 	duracao_max: $("input[name=duracao_max]").val(),
			      			 	valor_min: $("input[name=valor_min]").val(),
			      			 	valor_max: $("input[name=valor_max]").val()
		      			 	};
		      			 	
		      			 }},
		          processing: true,
            	  serverSide: true,
            	  ordering: false,
            	  "dom": '<"row" <"col-md-6"l><"col-md-6"f>>rt <"row"<"col-sm-5"i><"col-sm-7"p>>',
		          columns: [
		              {data: "src", name:"Origem"},
		              {data: "dst",    name:"Destino"},
		              {data: "start", name:"Start"},
		              {data: "billsec_time", name:"Billsec"},
		              {data: "cost", name:"Valor"},
		          ],
		          columnDefs : [
		          	{targets:4,
		          	 render: function(data, meta, full){
		          	 	return 'R$ '.concat(data);
		          	 }}
		          ]
		      });
	});
</script>
@endpush