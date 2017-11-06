<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="/lumino/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/lumino/css/styles.css">
	<link rel="stylesheet" type="text/css" href="/lumino/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/global_styles.css">
<head>
	<title> Ramal Virtual </title>
</head>
<body>
	<div id="content"></div>
	<script type="text/javascript">
		_ROUTES_ = {
			client : {
				get_cli_header_data : "{{route('cliente.get_header_data')}}",
				unmorph : "{{route('cliente.unmorph')}}",
				get_linhas_stats : "{{route('cliente.get_linhas_stats')}}"
			},
			extrato : {
				transacoes_data : "{{route('cliente.extrato.trasacoes.get')}}",
				ligacoes_data : "{{route('cliente.extrato.ligacoes.get')}}",
				ligacoes_export : "{{route('cliente.extrato.ligacoes.export')}}"
			},
			grupos : {
				get : "{{route('cliente.grupos_atendimento.get')}}",
				data : "{{route('cliente.grupos_atendimento.data')}}",
				store : "{{route('cliente.grupos_atendimento.store')}}",
				update : "{{route('cliente.grupos_atendimento.update')}}",
				destroy : "{{route('cliente.grupos_atendimento.destroy')}}",
			},
			linhas : {
				get_list : "{{route('cliente.linhas.get_list')}}"
			},
			gravacoes : {
				data: "{{route('cliente.gravacoes.data')}}",
				download: "{{route('cliente.gravacoes.download')}}",
				get_blob: "{{route('cliente.gravacoes.get_blob')}}"
			}
		}
	</script>
	<script type="text/javascript" src="/third_party/jquery/jquery.js"></script>
	<script type="text/javascript" src="/lumino/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/client.js"></script>

</body>
</html>
