@extends("base.base")

@section("content")
    
    <div class="panel panel-default panel-toggle">
    <div class="panel-heading">
           <div class="pull-right">
                <a id="popover-help-notf" tabindex="0" role="button" data-placement="left">
                    <span class="glyphicon glyphicon-question-sign gi-2x" aria-hidden="true"></span>
                </a>
          </div>
          <div class="">
            <h3 class="panel-title"> Configurar Notificação </h3>
          </div>
          <div class="clearfix"></div>
    </div>

    <div class="panel-body">

		<div class="row container-fluid">
			<form action="{{route('rv.notifications.flash.store')}}/{{$assinante_md5_id}}" method="POST">
                {{ csrf_field() }}
                @include("rv.notificacoes_flash.formfields")
    			<button class="btn btn-success btn-block"> Salvar </button>
    		</form>
		</div>

	  </div>
	</div>


@endsection

@push("scripts")
    <script type="text/javascript">
        $(function(){
            var tips_html = "<h4> <b>Dicas:</b> </h4>"+
                             "<ul>"+
                             "<li> Nos campos Texto da notificação e Texto do email, as variáveis <i>creditos_atuais </i>, <i>creditos_adicionados</i>, <i>creditos_removidos</i> e <i>nome_usuario</i> estão disponíveis."+
                             "</li>"+
                             "<li>"+
                             "Para usá-las basta inserir no texto {nome_da_variável}. Exemplo: olá {nome_usuario}, {creditos_adicionados} foram adicionados na sua conta."+
                             "</li>"+
                              "<li>"+
                             "As variáveis são relativas ao evento ao qual a notificação está ligada, ou seja, <i>creditos_adicionados</i> será sempre vazia quando o evento for 'Créditos Removidos'."+
                             "</li>"+
                             "</ul>";
            $("#popover-help-notf").popover({
                content: tips_html,
                html: true,
                trigger: 'hover'
            });
        })
    </script>
@endpush   