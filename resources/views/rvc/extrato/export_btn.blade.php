<a id="export-btn" href='#' class="btn btn-warning"> Exportar </a>

@push("scripts")

<script type="text/javascript">
	$(function(){

		var saveData = (function () {
		    var a = document.createElement("a");
		    document.body.appendChild(a);
		    a.style = "display: none";
		    return function (data, fileName) {
		        var data = data,
		            blob = new Blob([data], {type: "application/csv"}),
		            url = window.URL.createObjectURL(blob);
		        a.href = url;
		        a.download = fileName;
		        a.click();
		        window.URL.revokeObjectURL(url);
		    };
		}());

		$("#export-btn").on("click", function(ev){
			ev.preventDefault();

			$.ajax({
				url: "{{route('rvc.extrato.export')}}",
				method: "GET",
				data: { filters : {
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
				}
				},
				success: function(resp){
					
					
					saveData(resp, "Extrato_"+Date.now()+".csv");
					/*resp = JSON.parse(resp);

					if(resp.status !== 1){
						alert(0);
						
					}

					var blob = new Blob([resp],  {type: "application/csv"});
					var url = URL.createObjectURL(blob);
					window.location = url;

					alert(blob.size);*/
				},
				error: function(){
					/*swal("Erro",
						 "Um erro ocorreu ao gerar seu arquivo",
						 "danger");*/
						 alert(0);
				}
				});
		})
	})
</script>

@endpush