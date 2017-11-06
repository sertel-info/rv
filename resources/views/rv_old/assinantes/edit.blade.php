@extends("base.base")

@section("content")

{!! Form::model($assinante, ['route' => ['rv.assinantes.update', MD5($assinante->id)], 'method'=>'PUT', 'id'=>'form-assinantes'], ['class'=>'form-assinantes']) !!}
	@include("rv.assinantes.formfields_complete")
{!! Form::close() !!}


@endsection

@push("scripts")
	<script type="text/javascript">
		$(function(){
			$(".panel-toggle")
			.on('hidden.bs.collapse', function(){
				$el = $(this);
				$el.find(".collapse-icon").html($('<span class="glyphicon glyphicon-circle-arrow-down"> </span>'))
			})
			.on('shown.bs.collapse', function(){
				$el = $(this);
				$el.find(".collapse-icon").html($('<span class="glyphicon glyphicon-circle-arrow-up"> </span>'))
			});
		})
	</script>
@endpush