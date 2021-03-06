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
    <link href="{{ asset('css/css_bootstrap/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/r-2.2.1/datatables.min.css"/>

		{{-- bootStrap - Select Plugin --}}
		<link href="{{ asset('css/bootstrap_select/bootstrap-multiselect.css') }}" rel="stylesheet">

    <!--Fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">

    {{-- fileinput --}}
    <link href="{{ asset('css/fileinput/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>  
    <link href="{{ asset('css/fileinput/fileinput-rtl.css') }}" rel="stylesheet">
	

    <!-- Icons -->
    <link href="{{ asset('css/fontawesome/fontawesome-all.min.css') }}" rel="stylesheet">

	{{-- Theme Fileinput --}}
    <link href="{{ asset('css/themes/explorer-fa/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    
    {{-- css Datatable --}}
    <link href="{{ asset('css/datatable/styledatatable.css') }}" rel="stylesheet">

</head>
<body>

	<div class="container-fluid" id="wrapper">
		<div class="row">

			
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded ">

				<div id="accordion">
				  	<div class="card"> <!-- Inicio de Card 1 MENU ADO 2018-->
					    <div class="card-header" id="headingOne">
					      	<h1 class="site-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><a href="#">		       
					          ADO 2018				 
					      </a></h1>
					    </div>

					    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
					      <div  class="card-body">
								<ul class="nav nav-pills flex-column sidebar-nav margin_left_menu">
									<li class="nav-item"><a class="nav-link" href="{{('home')}}"><em class="fa fa-newspaper"></em> Dashboard <span class="sr-only">(current)</span></a></li>
									<li class="nav-item"><a class="nav-link" href="{{('crearAdo')}}"><em class="fa fa-edit"></em> Crear ADO</a></li>
									<li class="nav-item"><a class="nav-link" href="{{('informes')}}"><em class="fa fa-clone"></em> Buscar ADO</a></li>
									<li class="nav-item"><a class="nav-link" href="{{('buscarAdo')}}"><em class="fa fa-clone"></em> Informes</a></li>
									<li class="nav-item"><a class="nav-link" href="{{('graficos')}}"><em class="fa fa-bar-chart-o"></em> Gráficos</a></li>
								</ul>
					      </div>
					    </div>

				  	</div> <!-- fin de Card 1-->

				  	@if(Auth::user()->hasAnyRole([1,2,3]))
					<div class="card"> <!-- Inicio de Card 2 MENU GESTION-->
					    <div class="card-header" id="headingTwo">
					      	<h1 class="site-title " data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><a href="#">       
					           Menu gestión				 
					      </a></h1>
					    </div>

					    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					      <div id = 'Midiv' class="card-body">
								<ul id = 'Miul' class="nav nav-pills flex-column sidebar-nav margin_left_menu">
									<li id = 'Miil' class="nav-item"><a class="nav-link" href="#"><em class="fa fa-user-circle"></em> Alta descripción</a></li>
									<li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-users"></em> descripción</a></li>
									<li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-th-large"></em> presupuesto</a></li>
								</ul>
					      </div>
					    </div>
					</div> <!-- fin de Card 2-->
				  	@endif 
					<div class="card">
    					<div class="card-header" id="headingThree">
				      		<h1 class="site-title " data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><a href="#">       
					           Menu Administrador				 
					      	</a></h1>
    					</div>
					    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					      <div class="card-body">
								<ul class="nav nav-pills flex-column sidebar-nav margin_left_menu">
									<li class="nav-item"><a class="nav-link" href="{{('register')}}"><em class="fa fa-user-circle"></em> Dar Alta Usuario</a></li>
									<li class="nav-item"><a class="nav-link" href="{{('gestionUsers')}}"><em class="fa fa-users"></em> Gestión Usuario</a></li>
									<li class="nav-item"><a class="nav-link" href="{{('registrarRoles')}}"><em class="fa fa-th-large"></em> Dar Rol de Alta</a></li>
									<li class="nav-item"><a class="nav-link" href="{{('gestionRoles')}}"><em class="fa fa-th-list"></em>Gestión Roles</a></li>
								</ul>
					      </div>
				    	</div>
				  	</div>

				</div>


			</nav>
			<main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
				<header class="page-header row justify-center position_fixed">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">Dashboard</h1>
					</div>
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

						@if(file_exists("storage/uploads/usuarios/".Auth::user()->username."/"))
							<img src="storage/uploads/usuarios/{{ Auth::user()->username }}/imagenPerfil.png" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						@else
							<img src="images/profile-pic.png" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						@endif

						<div class="username mt-1">
							
							<h4 class="mb-1">{{ Auth::user()->name }}</h4>
							<h6 class="text-muted">{{Auth::user()->name}}</h6>
						</div>
						</a>
						
						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" href="{{('profile')}}"><em class="fa fa-user-circle mr-1"></em> View Profile</a>
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

    {{-- Jquery --}}
    <script src="//code.jquery.com/jquery.js"></script>	
    <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}" ></script>
    
    {{-- tether --}}
    <script src="{{asset ('https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js') }}"></script>

    {{-- bootstrap --}}
    <script src="{{ asset('js/js_bootstrap/bootstrap.min.js') }}"></script>

	    {{-- bootStrap - Select Plugin --}}
		<script src="{{ asset('js/bootstrap_select/bootstrap-multiselect.js') }}"></script>

    {{-- Datatable --}}
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/r-2.2.1/datatables.min.js"></script>
	<script src="{{ asset('js/datatable/scriptDatatable.js') }}"></script>

	{{-- moment Plugin --}}
	<script src="{{ asset('js/moment/moment-with-locales.js') }}" type="text/javascript"></script>

	{{-- validate Plugin --}}
	<script src="{{ asset('js/validate/validate.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/validate/additional-methods.js') }}" type="text/javascript"></script>
	
	{{-- js Propio ado --}}
	<script src="{{ asset('js/ado2018.js') }}" type="text/javascript"></script>

	{{-- //Fileinput --}}
	<script src="{{ asset('js/fileinput.min.js') }}" type="text/javascript"></script>

		{{-- Themes/idioma Fileinput --}}
		<script src="{{ asset('js/themes/explorer-fa/theme.js') }}" type="text/javascript"></script>
	    <script src="{{ asset('js/themes/fas/theme.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/locales/es.js') }}" type="text/javascript"></script>

	@stack('scripts')
	</body>
</html>
