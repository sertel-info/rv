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
				get_linhas_stats : "{{route('cliente.get_linhas_stats')}}",
				get_filas_stats : "{{route('cliente.get_filas_stats')}}",
				get_user_perms : "{{route('cliente.get_user_perms')}}"
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
				get_list : "{{route('cliente.linhas.get_list')}}",
				data : "{{route('cliente.linhas.data')}}"
			},
			gravacoes : {
				data: "{{route('cliente.gravacoes.data')}}",
				download: "{{route('cliente.gravacoes.download')}}",
				get_blob: "{{route('cliente.gravacoes.get_blob')}}"
			},
			uras: {
				get : "{{route('cliente.uras.get')}}",
				store : "{{route('cliente.uras.store')}}",
				update : "{{route('cliente.uras.update')}}",
				destroy : "{{route('cliente.uras.destroy')}}",
				get_options : "{{route('cliente.uras.get_options')}}",
				get_audio : "{{route('cliente.uras.get_audio')}}",
				data : "{{route('cliente.uras.data')}}",
				destroy : "{{route('cliente.uras.destroy')}}"
			},
			filas: {
				get : "{{route('cliente.filas.get')}}",
				store : "{{route('cliente.filas.store')}}",
				update : "{{route('cliente.filas.update')}}",
				destroy : "{{route('cliente.filas.destroy')}}",
				data : "{{route('cliente.filas.data')}}"
			},
			saudacoes: {
				get : "{{route('cliente.saudacoes.get')}}",
				get_audio : "{{route('cliente.saudacoes.get_audio')}}",
				store : "{{route('cliente.saudacoes.store')}}",
				update : "{{route('cliente.saudacoes.update')}}",
				destroy : "{{route('cliente.saudacoes.destroy')}}",
				data : "{{route('cliente.saudacoes.data')}}"
			},
			configuracoes : {
				get_perm_linha : "{{route('cliente.config.get_perm_linha')}}",
				update_linha : "{{route('cliente.config.update_linha')}}",
				get_linha_conf_data : "{{route('cliente.config.get_linha_conf_data')}}",
				get_at_auto_opts : "{{route('cliente.config.get_at_auto_opts')}}",
				get_saudacoes_list : "{{route('cliente.config.get_saudacoes_list')}}",
			},
			correio_voz : {
				data : "{{route('cliente.correio_voz.data')}}"
			},
			notificacoes : {
				get_new : "{{route('cliente.notificacoes.get_new')}}",
				get_list : "{{route('cliente.notificacoes.get_list')}}",
				mark : "{{route('cliente.notificacoes.mark')}}"
			}
		}
	</script>
	<script type="text/javascript" src="/third_party/jquery/jquery.js"></script>
	<script type="text/javascript" src="/lumino/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/client.js"></script>

</body>
</html>
