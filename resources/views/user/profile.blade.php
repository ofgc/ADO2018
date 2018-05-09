@extends('layouts.principal')

@section('content')

	<form method="POST" id="profile-form" enctype="multipart/form-data"	>
		@csrf
		<div id = "container center_all">
			<div class="row margin_top_profile">
				<label class="col-md-3" for="usernameProfile">Username</label>
	      		<input class="col-md-4" type="text" id="usernameProfile" class="form-control" disabled value="{{Auth::user()->username}}">
	      	</div>
			<div class="row margin_top_profile">
				<label class="col-md-3" for="nameProfile">Nombre de Usuario</label>
	      		<input class="col-md-4" type="text" id="nameProfile" class="form-control" value="{{Auth::user()->name}}">
	      	</div>
	      	<div class="row margin_top_profile">
				<label class="col-md-3" for="passwordProfile">Nueva contraseña</label>
	      		<input class="col-md-4" type="text" id="passwordProfile" class="form-control" value="">
	      	</div>
	      	<div class="row">
	      		 <label for= "images" class="control-label col-md-12 margin-top_profile">Imagen de perfil</label>
	              <div class="file-loading col-md-12"> 
	                  <input id="images" name="images[]" type="file" multiple> 
	              </div>  
	      	</div>
		</div>
		<input id="idProfile" hidden value="{{ Auth::user()->id }}">
	</form>
	<div id="alert_success" class=" noneDisplay margin_top_profile alert alert-success">Los datos han sido actualizados correctamente</div>

	<div id="alert_fail" class=" noneDisplay margin_top_profile alert alert-danger"> Algo fallo durante la actualición del perfil</div>

@stop