<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<link rel="icon" href="favicon.ico">
	
	<title>Medialoot Bootstrap 4 Dashboard Template</title>

    <!-- Bootstrap core CSS -->
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/r-2.2.1/datatables.min.css"/>

    <!--Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i' rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link href="{{ asset('css/fontawesome/fontawesome-all.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    
    {{-- css Datatable --}}
    <link href="{{ asset('css/datatable/styledatatable.css') }}" rel="stylesheet">

</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
				<h1 class="site-title"><a href="index.html"><em class=""></em> ADO 2018</a></h1>
				
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item"><a class="nav-link" href="{{('home')}}"><em class="fa fa-dashboard"></em> Dashboard <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="{{('crearAdo')}}"><em class="fa fa-calendar-o"></em> Crear ADO</a></li>
					<li class="nav-item"><a class="nav-link" href="{{('informes')}}"><em class="fa fa-hand-o-up"></em>Buscar ADO</a></li>
					<li class="nav-item"><a class="nav-link" href="{{('buscarAdo')}}"><em class="fa fa-clone"></em>Informes</a></li>
					<li class="nav-item"><a class="nav-link" href="{{('graficos')}}"><em class="fa fa-bar-chart"></em> Gráficos</a></li>
				</ul>

				@if(Auth::user()->hasRole('admin'))
					<h1 class="site-title"><a href="index.html"><em class=""></em> Menu Administrador</a></h1>

					<ul class="nav nav-pills flex-column sidebar-nav">
						<li class="nav-item"><a class="nav-link" href="{{('register')}}"><em class="fa fa-user-circle-o"></em> Dar Alta Usuario</a></li>
						<li class="nav-item"><a class="nav-link" href="{{('gestionUsers')}}"><em class="fa fa-users"></em> Gestión Usuario</a></li>
						<li class="nav-item"><a class="nav-link" href="{{('registrarRoles')}}"><em class="fa fa-vcard"></em> Dar Rol de Alta</a></li>
						<li class="nav-item"><a class="nav-link" href="{{('gestionRoles')}}"><em class="fa fa-vcard"></em>Gestión Roles</a></li>
					</ul>
				@endif

				<a class="logout-button dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                   <em class="fa fa-power-off mr-1"></em>  {{ __('Cerrar Sesión') }}
                </a>
			</nav>
			
			<main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
				<header class="page-header row justify-center position_fixed">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">Dashboard</h1>
					</div>
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="images/profile-pic.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						
						<div class="username mt-1">
							
							<h4 class="mb-1">{{ Auth::user()->name }}</h4>
							
							<h6 class="text-muted">{{Auth::user()->name}}</h6>
						</div>
						</a>
						
						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" href="#"><em class="fa fa-user-circle mr-1"></em> View Profile</a>
						     <a class="dropdown-item" href="#"><em class="fa fa-sliders mr-1"></em> Preferences</a>
						     <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <em class="fa fa-power-off mr-1"></em>  {{ __('Cerrar Sesión') }}
                                        	
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                              </form>
						</div>
					</div>
					
					<div class="clear"></div>
				</header>
				<div class="container">
				@yield('content')
				</div>
			</main>	
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//code.jquery.com/jquery.js"></script>	
    <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}" ></script>
    {{-- <script src="{{ asset('https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js') }}" defer></script> --}}
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/r-2.2.1/datatables.min.js"></script>
	<script src="{{ asset('js/datatable/scriptDatatable.js') }}"></script>
	@stack('scripts')
	</body>
</html>
