<!DOCTYPE html>
<html>
<head>
    <meta name="_token" content="{{csrf_token()}}"></meta>
    <title>{{ config('app.name', '') }}</title>
    <link rel="stylesheet" type="text/css" href="/third_party/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    @stack("headers")
</head>

<body>
    <div class="container">
        @include("base.top_nav_bar")
        <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$panel_title or ''}}</h3>
                    </div>
                    <div class="panel-body">
                    @if(Auth::user()->role == 0)
                        @include("base.admins.side_nav_bar")
                    @else
                        @include("base.clientes.side_nav_bar")
                    @endif
                        <div class='col-md-9'>
                            <div class="container-fluid">
                                @yield('content')
                            </div>  
                        </div>
                    </div>
        </div>
    </div>
</body>

<script type="text/javascript" src="/third_party/jquery/jquery.js"></script>

<script type="text/javascript" src="/third_party/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/third_party/jquery/jquery.toaster.js"></script>

<script type="text/javascript">
    $(function(){
        @if(Session::has("msg_txt"))
            $.toaster({ priority : "{{Session::get('msg_type')}}",
                        title : "{{Session::get('msg_title')}}",
                        message : "{{Session::get('msg_txt')}}",
                       });
        @endif
     
        @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        $.toaster({ priority : "danger",
                                    title : "Erro",
                                    message : "{{$error}}",
                        });
                    @endforeach
        @endif


    });
</script>
@stack("scripts")
</html>



