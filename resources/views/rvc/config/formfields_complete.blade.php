<div class="panel panel-default panel-toggle">
    <div class="panel-heading">
        <h3 class="panel-title"> Linha <u>{{$linha->nome}}</u>
            <div class="collapse-icon pull-right">
            <span class="glyphicon glyphicon-circle-arrow-down"> </span>
          </div>
        </h3>
    </div>

    <div class="panel-body" id="body-facilidades-{{$linha->md5_id}}">

        
        {{csrf_field()}}
        
        @include('rvc.config.formfields.facilidades')
        @include('rvc.config.formfields.atend_automatico')

        @if(Auth::User()->assinante->facilidades->saudacoes)
          @include('rvc.config.formfields.saudacoes')
        @endif

        <button class='btn-block btn btn-success'> Salvar </button>

    </div>
</div>

@push("scripts")

 <script type="text/javascript">
 	$(function(){
    var checkboxes = "input[name=cadeado_pessoal], "+ 
                     "input[name=caixa_postal], "+
                     "input[name=siga_me], "+
                     "input[name=atend_automatico]";

 		
    $(checkboxes).on("init.bootstrapSwitch switchChange.bootstrapSwitch", function(ev, state){
          $(this).parents('.form-group:first')
                      .find("div.collapse")
                      .collapse(state ? "show" : "hide");
    });


		$("select[name=atend_automatico_destino]").on("rv_finished_changing", function(){
      $(this).val("{{ $linha->facilidades->atend_automatico_destino }}").trigger("change");
		})

    $("select[name=atend_automatico_tipo]").trigger('change');
		


 	});
 </script>
@endpush