@extends("base.base")

@section("content")

{!! Form::model($linha, ['route' => ['rv.linhas.update'], 'method'=>'put', 'id'=>'form-linhas']) !!}
	{{Form::hidden('_id', $linha->id)}}
	{{Form::hidden('_id_did', $linha->id_did)}}
	@include("rv.linhas.formfields_complete")

{!! Form::close() !!}

@endsection

@push("scripts")
	<script type="text/javascript">
		$(function(){
			$("select[name=atend_automatico_destino]").on("rv_finished_changing", function(){
		    	$(this).val("{{ $linha->facilidades->atend_automatico_destino }}").trigger("change");
			});
		})
	</script>
@endpush