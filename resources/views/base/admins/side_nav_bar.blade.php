<div class="col-md-3 left-navbar well">

	<ul id="outside-list" class="nav nav-pills nav-stacked">
	    <li>
          <a class='' data-toggle="collapse" data-parent="#stacked-menu" href="#assinantes_toggle">
		  <span class='glyphicon glyphicon-user' aria-hidden='true'></span> 
          Assinantes <span class="caret arrow"></span></a>
         
          <ul class="nav nav-pills nav-stacked collapse inner-pill-list" id="assinantes_toggle">
            <li data-parent="" class='inner-nav {{isset($active) && $active == "ass_criar" ? "active" : "" }}'> 
		   		<a href="{{route('rv.assinantes.create')}}">
		   		<span class="glyphicon glyphicon-plus-sign"></span>
		   		&nbsp Criar 
		   		</a> 
	   		</li>
            <li data-parent="outside-list" class='inner-nav {{isset($active) && $active == "ass_listar" ? "active" : "" }}'>
		   		<a href="{{route('rv.assinantes.manage')}}" >
		   		<span class="glyphicon glyphicon-cog"></span>
		   		&nbsp Gerenciar
		   		</a> 
	 	    </li>
          </ul>

        </li>
        <li>
          <a class='' data-toggle="collapse" data-parent="#stacked-menu" href="#linhas_toggle">
		  <span class='glyphicon glyphicon-resize-small' aria-hidden='true'></span> 
          Linhas <span class="caret arrow"></span></a>
          <ul class="nav nav-pills nav-stacked collapse inner-pill-list" id="linhas_toggle">
            <li data-parent="" class='inner-nav {{isset($active) && $active == "lin_criar" ? "active" : "" }}'> 
		   		<a href="{{route('rv.linhas.create')}}">
		   		<span class="glyphicon glyphicon-plus-sign"></span>
		   		&nbsp Criar 
		   		</a> 
	   		</li>
            <li data-parent="outside-list" class='inner-nav {{isset($active) && $active == "lin_listar" ? "active" : "" }}'>
		   		<a href="{{route('rv.linhas.manage')}}" >
		   		<span class="glyphicon glyphicon-cog"></span>
		   		&nbsp Gerenciar
		   		</a> 
	 	    </li>
          </ul>
        </li>

        <li>
          <a class='' data-toggle="collapse" data-parent="#stacked-menu" href="#planos_toggle">
		  <span class='glyphicon glyphicon-dashboard' aria-hidden='true'></span> 
          Planos <span class="caret arrow"></span></a>
          <ul class="nav nav-pills nav-stacked collapse inner-pill-list" id="planos_toggle">
	            <li daa-parent="" class='inner-nav {{isset($active) && $active == "pla_criar" ? "active" : "" }}'> 
			   		<a href="{{route('rv.planos.create')}}">
			   		<span class="glyphicon glyphicon-plus-sign"></span>
			   		&nbsp Criar 
			   		</a> 
		   		</li>
	            <li data-parent="outside-list" class='inner-nav {{isset($active) && $active == "pla_gerenciar" ? "active" : "" }}'>
			   		<a href="{{route('rv.planos.manage')}}" >
			   		<span class="glyphicon glyphicon-cog"></span>
			   		&nbsp Gerenciar
			   		</a> 
		 	    </li>
          </ul>
        </li>

		<li>
          <a class='' data-toggle="collapse" data-parent="#stacked-menu" href="#configuracoes_toggle">
		  <span class='glyphicon glyphicon-cog' aria-hidden='true'></span> 
          &nbsp Configuracoes 
 			<span class="caret arrow"></span></a>
            <ul class="nav nav-pills nav-stacked collapse inner-pill-list" id="configuracoes_toggle">
	            <li data-parent="outside-list" class=' inner-nav {{ isset($active) && $active == "configuracoes.geral" ? "active" : "" }}'> 
			   		<a href="{{route('rv.configuracoes.geral')}}">
			   		<span class="glyphicon glyphicon-cog"></span>
			   		&nbsp Geral
			   		</a> 
		   		</li>
	            <li data-parent="outside-list" class=' inner-nav {{ isset($active) && $active == "configuracoes.voice_mail" ? "active" : "" }}'> 
			   		<a href="{{route('rv.configuracoes.voice_mail')}}">
			   		<span class="glyphicon glyphicon-cog"></span>
			   		&nbsp Voice Mail 
			   		</a> 
		   		</li>
	            
	            <!-- <li data-parent="outside-list" class='inner-nav {{isset($active) && $active == "pla_gerenciar.notificacoes" ? "active" : "" }}'>
			   		<a href="{{route('rv.configuracoes.notificacoes')}}" >
			   		<span class="glyphicon glyphicon-cog"></span>
			   		&nbsp Notificações
			   		</a> 
		 	    </li> -->
            </ul>
        </li>


	</ul>

</div>