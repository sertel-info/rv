@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/datatables/css/datatables.min.css">

@endpush


			    <table class="table table-bordered table-hover table-striped table-responsive" id="table-extrato">
				    <thead>
				        <tr>
				            <th>Origem</th>
				            <th>Destino</th>
				            <th>Data</th>
				            <th>Hora</th>
				            <th>Duração</th>
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
		$("#table-extrato").dataTable({
		          ajax: {
		          		url: "{{route('rvc.extrato.linha.data')}}"+"{{ (isset($linha) ? '/'.md5($linha->id) : '')}}",
		          		data: function(data){
				          	data.filters = {
				          		tipo_chamada : $("select[name='tipo_chamada']").val(),
				          		tipo_destino : $("select[name='tipo_destino']").val(),
				          		origem : $("input[name='origem']").val(),
				          		destino : $("input[name='destino']").val(),
				          		data_min : $("input[name='data_min']").val(),
				          		data_max : $("input[name='data_max']").val(),
				          		hora_min : $("input[name='hora_min']").val(),
				          		hora_max : $("input[name='hora_max']").val(),
				          		duracao_min : $("input[name='duracao_min']").val(),
				          		duracao_max : $("input[name='duracao_max']").val()
				          	};
				        }
		      	  },
		          processing: true,
            	  serverSide: true,
            	  ordering: false,
            	  searching:false,
		          columns: [
		              {data: "origem", name:"Origem"},
		              {data: "destino",    name:"Destino"},
		              {data: "date", name:"Date"},
		              {data: "time", name:"Time"},
		              {data: "billsec_time", name:"Billsec"},
		              {data: "cost", name:"Valor"},
		          ],
		          columnDefs : [
		          {
		          	targets: 5, 
		          	render: function(data){
		          		return data.toString().concat(' R$');
		          	}
		          },
		          {
		          	targets: 0, 
		          	render: function(data){
		          		data = data.replace(/^[0]/, "");
		          		if(data.length >= 10 && data.length <= 14){
		          			//return data;
		          			
		          			var num_arr = data.match(/^(00|0|9090|90|55)?(([0-9]{2})?([0-9]{2}))?(([0-9])[0-9]{7,})(\s.*)?/);

		          			var ddd = num_arr[4] !== undefined ? "("+num_arr[4].toString()+")" : "";
		          			
		          			if(num_arr[5]){
		          				var num = num_arr[5];
		          				num = num.replace(/^([0-9]{4,5})([0-9]{4})$/, "$1-$2");
		          			} else {
		          				num = data;
		          			}
		          			
		          			return ddd.concat(' ',num);

		          		}

		          		return data;
		          	}
		          },
		          {
		          	targets: 1, 
		          	render: function(data){
		          		data = data.replace(/^[0]/, "");
		          		if(data.length >= 8 && data.length <= 25){
		          			//return data;
		          			
		          			var num_arr = data.match(/^(00|0|9090|90|55)?(([0-9]{2})?([0-9]{2}))?(([0-9])[0-9]{7,})(\s.*)?/);

		          			var ddd = num_arr[4] !== undefined ? "("+num_arr[4].toString()+")" : "";
		          			
		          			if(num_arr[5]){
		          				var num = num_arr[5];
		          				var resto = num_arr[7] !== undefined ? num_arr[7] : "";  
		          				num = num.replace(/^([0-9]{4,5})([0-9]{4})$/, "$1-$2");
		          			} else {
		          				var resto = "";
		          				num = data;
		          			}
		          			
		          			return ddd.concat(' ',num, resto);

		          		}

		          		return data;
		          	}
		          }

		          ]
		      });
	});
</script>
@endpush