<div class="col-md-3 left-navbar well">

	<ul id="outside-list" class="nav nav-pills nav-stacked">
	    <li class="{{isset($active) && $active == 'gravacoes' ? 'active' : '' }}">
          <a data-parent="#stacked-menu" href="{{route('rvc.gravacoes.index')}}" >
			<span class='glyphicon glyphicon-headphones' aria-hidden='true'></span> 
	        Gravações 
          </a>
        </li>
         <li class="{{isset($active) && $active == 'correio_voz' ? 'active' : '' }}">
          <a data-parent="#stacked-menu" href="{{route('rvc.correio_voz.index')}}" >
			<span class='glyphicon glyphicon-envelope' aria-hidden='true'></span> 
	        Caixa de Entrada
          </a>
        </li>
		<li class="{{isset($active) && $active == 'extrato' ? 'active' : '' }}">
          <a data-parent="#stacked-menu" href="{{route('rvc.extrato.index')}}" >
			<span class='glyphicon glyphicon-usd' aria-hidden='true'></span> 
	        Extrato 
          </a>
        </li>
	    <li class="{{isset($active) && $active == 'config' ? 'active' : '' }}">
          <a data-parent="#stacked-menu" href="{{route('rvc.config.index')}}" >
			<span class='glyphicon glyphicon-wrench' aria-hidden='true'></span> 
	        Configurações 
          </a>
        </li>
	</ul>

</div>