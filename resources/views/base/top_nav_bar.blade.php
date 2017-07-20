
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"> {{ config('app.name', '') }} </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
       <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                           
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            {{-- <li><a href="{{ url('/register') }}">Registrar</a></li> --}}
                            
                        @else

                            @if(Session::has("is_morphed") && Session::get("is_morphed") == true)
                                <li><a href="{{ route('rv.unmorph') }}">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                     Voltar como admin
                                    </a>
                                </li>
                            @endif

                            @if(Auth::User()->role == 1)
                                <li>
                                    <a class=''>Créditos : {{Auth::User()->assinante()->first()->financeiro->creditos}} R$
                                    </a>
                                </li>
      
                            @endif


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('rvc.conta.edit') }}">
                                            Conta
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Sair
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

@push("scripts")    
    <script type="text/javascript">
        $(function(){
            var popover_content = $("#notifications-stub");
           
            $("[data-toggle=popover]").popover({
                title: "Notificações",
                content: popover_content.html(),
                html: true
            });
            
            popover_content.remove();

            $('body').on("click", '.close', function(){
              //diminui 1 no contador do "Mais X ..."
              var oflow = $("#overflow");

              if(oflow.length > 0){
                var count = oflow.find("#overflow-count");
                var curr_val = parseInt(count.html());
                var new_val = curr_val-1;

                if(new_val == 0){
                    oflow.remove();
                } else {
                    count.html(new_val);
                }

              }

              $(this).parents(".media-line").hide();

            });
        })
    </script>
@endpush