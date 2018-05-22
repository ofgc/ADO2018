@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar rol') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ /*action('RoleController@create')*/ }}"> --}}
                        
                    <form id ="form-roles">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" >

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Nivel de seguridad') }}</label>

                            <div class="col-md-6">
                                <input id="level" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="level" value="{{ old('level') }}" >

                                @if ($errors->has('level'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('agregar Rol') }}
                                </button>
                            </div>
                        </div>
                        <div id="alert_success" class=" noneDisplay margin_top_profile alert alert-success">El rol ha sido creado correctamente</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
