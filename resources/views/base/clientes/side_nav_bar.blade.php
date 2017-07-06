<div class="col-md-3 left-navbar well">

	<ul id="outside-list" class="nav nav-pills nav-stacked">
	      
        @if(Auth::user()->assinante->facilidades->__get("gravacoes"))
          <li class="{{isset($active) && $active == 'gravacoes' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.gravacoes.index')}}" >
    			    <span class='glyphicon glyphicon-headphones' aria-hidden='true'></span> 
    	        Gravações 
            </a>
          </li>
        @endif

        @if(Auth::user()->assinante->facilidades->__get("correio_voz"))
          <li class="{{isset($active) && $active == 'correio_voz' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.correio_voz.index')}}" >
  		        <span class='glyphicon glyphicon-envelope' aria-hidden='true'></span> 
  	          Caixa de Entrada
            </a>
          </li>
		    @endif

        @if(Auth::user()->assinante->facilidades->__get("acesso_extrato"))
          <li class="{{isset($active) && $active == 'extrato' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.extrato.index')}}" >
  			     <span class='glyphicon glyphicon-usd' aria-hidden='true'></span> 
  	         Extrato 
            </a>
          </li>
        @endif
     
        @if(Auth::user()->assinante->facilidades->__get("grupos_atendimento"))
          <li class="{{isset($active) && $active == 'grupos_atend' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.grupos_atendimento.index')}}" >
  			     <span class='glyphicon glyphicon-random' aria-hidden='true'></span> 
  	         Grupos de atendimento 
            </a>
          </li>
        @endif

        @if(Auth::user()->assinante->facilidades->__get("ura"))     
          <li class="{{isset($active) && $active == 'ura' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.ura.index')}}" >
             <span class='glyphicon glyphicon-play-circle' aria-hidden='true'></span> 
             URA
            </a>
          </li>
        @endif

        @if(Auth::user()->assinante->facilidades->__get("fila"))     
          <li class="{{isset($active) && $active == 'filas' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.filas.index')}}" >
              <span class=' glyphicon glyphicon-log-in' aria-hidden='true'></span> 
              Filas 
            </a>
          </li>
        @endif

        @if(Auth::user()->assinante->facilidades->__get("saudacoes"))     
          <li class="{{isset($active) && $active == 'saudacoes' ? 'active' : '' }}">
            <a data-parent="#stacked-menu" href="{{route('rvc.saudacoes.index')}}" >
              <span class=' glyphicon glyphicon glyphicon-star' aria-hidden='true'></span> 
              Saudações 
            </a>
          </li>
        @endif

  	    <li class="{{isset($active) && $active == 'config' ? 'active' : '' }}">
          <a data-parent="#stacked-menu" href="{{route('rvc.config.index')}}" >
  		      	<span class='glyphicon glyphicon-wrench' aria-hidden='true'></span> 
  	         Configurações 
           </a>
        </li>
	</ul>

</div>