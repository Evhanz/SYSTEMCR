<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Evhanz">

    <title>Cristo Rey - SystemCR</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('sb-admin.css') }}" rel="stylesheet">
    <!-- miCSS -->

    <link href="{{ asset('custom.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome-4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/config/config.js') }}"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="navTop">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::Route('home') }}" id="titulo">SysCR</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav ">

           <!-- <form class="form-inline">-->
        @if (Auth::check())
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->usuario }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if(is_admin())
                <li>
                    <a href="{{ route('account') }}"><i class="fa fa-fw fa-envelope"></i> Editar Usuario</a>
                </li>
                @endif
                <li class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
         </li>
        @else
           <li class="navbar-form navbar-right">
           {{ Form::open(['route' => 'login','method' => 'POST', 'role' => 'form','class' => 'form-inline']) }}

               @if(Session::has('login_error'))
                  <span class="label label-danger">Usuario o contraseña no valido</span>
               @endif
                <div class="form-group">
                    {{ Form::email('email',null,['class' => 'form-control','placeholder' => 'example@example.com']) }}


                </div>
                <div class="form-group">
                    {{ Form::password('password',['class' => 'form-control','placeholder' => 'tu Contraseña']) }}
                </div>
                <!--
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
                -->
                <button type="submit" class="btn btn-success">Sign in</button>
           {{ Form::close() }}
           </li>
        @endif


    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav navTop" id="listaPrincipal">
            <li  id="principal"  class="hidden-xs">
                <img src="{{ asset('imagenes/adds/logo.png') }}" alt="Cristo Rey" width="150px"/>
            </li>

            @if (Auth::check())
            @if(is_admin())
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#sub-Usuario"><i class="fa fa-archive"></i>

                </i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="sub-Usuario" class="collapse subMenu" >
                    <li>
                        <a href="{{ URL::route('frmUsuarios')}}">
                        <i class="fa fa-database"></i>
                         Usuarios
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#sub-Persona"><i class="fa fa-street-view"></i>

                </i> Personas <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="sub-Persona" class="collapse subMenu" >
                    <li>
                        <a href="{{ URL::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))}}">
                        <i class="fa fa-graduation-cap"></i>
                        Alumnos
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Apoderado','criterio'=>'*'))}}">
                        <i class="fa fa-user-secret"></i>
                        Apoderados
                        </a>
                    </li>
                </ul>
            </li>

            @endif
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#sub-Reuniones"><i class="fa fa-users"></i>

                </i> Reuniones <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="sub-Reuniones" class="collapse subMenu" >
                    <li>

                        <a href="{{ URL::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))}}"> <i class="fa fa-comments"></i> Ver Todos</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('viewPersonasByDeudas',array('criterio'=>'*'))}}">
                       <i class="fa fa-plus-circle"></i>
                        Ver Deudas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#sub-Reportes"><i class="fa fa-fw fa-arrows-v">

                </i> Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="sub-Reportes" class="collapse subMenu" >
                    <li>
                        <a href="{{ URL::route('frmReporte')}}">
                        <i class="fa fa-server"></i>
                        Ver Todos</a>
                    </li>

                </ul>
            </li>
            @endif

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>


<!-- aca empieza el contenido-->
    <div id="page-wrapper">

        <div class="container-fluid" id="bodyContent">
        @yield('content')
        </div>
        <!-- /.container-fluid -->

    </div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>



</body>

</html>

