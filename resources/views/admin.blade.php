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
			dashboard : {
				stats : "{{route('admin.dashboard.get.stats')}}",
				get_admin_header_data : "{{route('admin.dashboard.get.header_data')}}"
			},
			linhas : {
				data : "{{route('admin.linhas.datatables')}}",
				destroy : "{{route('admin.linhas.destroy')}}",
				update : "{{route('admin.linhas.update')}}",
				store : "{{route('admin.linhas.store')}}",
				get : "{{route('admin.linhas.get')}}"
			},
			assinantes : {
				data : "{{route('admin.assinantes.datatables')}}",
				destroy : "{{route('admin.assinantes.destroy')}}",
				get_all : "{{route('admin.assinantes.get_all')}}",
				store : "{{route('admin.assinantes.store')}}",
				get : "{{route('admin.assinantes.get')}}",
				update : "{{route('admin.assinantes.update')}}",
				morph : "{{route('admin.assinantes.morph')}}",
				unmorph : "{{route('admin.assinantes.update')}}",
				add_credits : "{{route('rv.assinantes.creditos.increase')}}",
				rmv_credits : "{{route('rv.assinantes.creditos.decrease')}}"
			},
			planos: {
				store : "{{route('admin.planos.store')}}",
				data : "{{route('admin.planos.datatables')}}",
				get_all : "{{route('admin.planos.get_all')}}",
				get : "{{route('admin.planos.get')}}",
				destroy : "{{route('admin.planos.destroy')}}",
				update : "{{route('admin.planos.update')}}"
			},
			notificacoes_flash: {
				store : "{{route('admin.notif.flash.store')}}",
			},
			configuracoes: {
				update : "{{route('admin.configuracoes.update')}}",
				get : "{{route('admin.configuracoes.get')}}"
			},
			notificacoes: {
				update : "{{route('admin.notif.update')}}",
				store : "{{route('admin.notif.store')}}",
				destroy : "{{route('admin.notif.destroy')}}",
				data : "{{route('admin.notif.data')}}",
				get : "{{route('admin.notif.get')}}"
			}
		}
	</script>
	<script type="text/javascript" src="/third_party/jquery/jquery.js"></script>
	<script type="text/javascript" src="/lumino/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/admin.js"></script>
	
</body>
</html>
