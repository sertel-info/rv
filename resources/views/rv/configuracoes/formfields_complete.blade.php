@push("headers")
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
@endpush


@include('rv.configuracoes.formfields.geral')
@include('rv.configuracoes.formfields.voice_mail')
@include('rv.configuracoes.formfields.notifications')

<button class='btn btn-success btn-block'> Salvar </button>


@push("scripts")
	<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
@endpush