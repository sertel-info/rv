@extends("base.base")
@push('headers')
	<link rel="stylesheet" type="text/css" href="/third_party/bootstrap_switch/css/bootstrap-switch.min.css">
@endpush

@section("content")

@include("rvc.config.formfields_complete")


@endsection

@push("scripts")

<script type="text/javascript" src="/third_party/bootstrap_switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('input[type=checkbox]').bootstrapSwitch();
	});
</script>
@endpush