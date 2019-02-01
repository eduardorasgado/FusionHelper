@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary"
               href="{{ route('admin') }}">Atrás</a>
        </div>
        <h1>Registros de almacén</h1>
        <br><br>
        <br>
    </div>
    <div class="container-fluid">
        <div class="text-center">
            <h3>Formularios de registro</h3>
            <br>
            <span class="alert alert-info">Seleccione el botón correspondiente a su elección para el registro deseado.
                Presione el mismo botón para cancelar registro.</span>
            <br><br><br>
            @if(Session::has('successProveedor'))
                <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('successProveedor') }}</span>
                </div>
            @endif
            @if(Session::has('Error'))
                <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                    <span class="text-danger">{{ Session::get('Error') }}</span>
                </div>
            @endif
            <div class="row text-center">
                {{-- MENSAJES DE SUCCESS DESDE LOS CONTROLLERS DE PROVEEDOR, ACTIVO Y ACCESORIOS--}}
                <div class="col-md-5"></div>
                <p>
                    <a href="#multiCollapse1" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse1">
                        Proveedor
                    </a> &nbsp;&nbsp;&nbsp;
                    <a href="#multiCollapse2" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse2">
                        Activo
                    </a>&nbsp;&nbsp;
                    <a href="#multiCollapse3" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse3">
                        Accesorio
                    </a>
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse1">
                    <div class="card card-header">
                        <h3>Registro de Proveedor</h3>
                    </div>
                    <div class="card card-body">
                        <form action="{{ route('postProveedorRegistro') }}"
                              method="POST" onsubmit="return confirm('Está seguro de hacer este registro?')">
                            @csrf

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ old('apellidos') }}" required autofocus>

                                    @if ($errors->has('apellidos'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Número telefónico') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required>

                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

                                <div class="col-md-6">
                                    <input id="rfc" type="text" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc" value="{{ old('rfc') }}" required>

                                    @if ($errors->has('rfc'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rfc') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar proveedor') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse2">
                    <div class="card card-header">
                        <h3>Registro de Activo</h3>
                    </div>
                    <div class="card card-body">
                        <div class="card card-body">
                            <form action="{{ route('postActivoRegistro') }}"
                                  method="POST" onsubmit="return confirm('Está seguro de hacer este registro?')">
                                @csrf

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="serie" class="col-md-4 col-form-label text-md-right">{{ __('Serie') }}</label>

                                    <div class="col-md-6">
                                        <input id="serie" type="text" class="form-control{{ $errors->has('serie') ? ' is-invalid' : '' }}" name="serie" value="{{ old('serie') }}" required autofocus>

                                        @if ($errors->has('serie'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('serie') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="etiqueta" class="col-md-4 col-form-label text-md-right">{{ __('Etiqueta') }}</label>

                                    <div class="col-md-6">
                                        <input id="etiqueta" type="text" class="form-control{{ $errors->has('etiqueta') ? ' is-invalid' : '' }}" name="etiqueta" value="{{ old('etiqueta') }}" required>

                                        @if ($errors->has('etiqueta'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('etiqueta') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="marca" class="col-md-4 col-form-label text-md-right">{{ __('Marca') }}</label>

                                    <div class="col-md-6">
                                        <input id="marca" type="text" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" name="marca" value="{{ old('marca') }}" required>

                                        @if ($errors->has('marca'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                                    <div class="col-md-6">
                                        <input id="modelo" type="text" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" name="modelo" value="{{ old('modelo') }}" required>

                                        @if ($errors->has('modelo'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('modelo') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                    <div class="col-md-6">
                                        <input id="color" type="text" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" value="{{ old('color') }}" required>

                                        @if ($errors->has('color'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}"
                                                  name="descripcion" value="{{ old('descripcion') }}" required></textarea>

                                        @if ($errors->has('descipcion'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0 text-center">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar Activo') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse3">
                    <div class="card card-header">
                        <h3>Registro de Accesorio</h3>
                    </div>
                    <div class="card card-body">
                        <div class="card card-body">
                            <form action="{{ route('postAccesorioRegistro') }}"
                                  method="POST" onsubmit="return confirm('Está seguro de hacer este registro?')">
                                @csrf

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="activoId" class="col-md-4 col-form-label text-md-right">{{ __('Activo') }}</label>
                                    <select class="form-control col-md-6" id="activoId" name="activoId">
                                        <option value="">Sin activo</option>
                                        @foreach ($activos as $activo)
                                            <option value="{{ $activo->id }}">{{ $activo->nombre }} |
                                                marca: {{ $activo->marca }} | modelo: {{ $activo->modelo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="serie" class="col-md-4 col-form-label text-md-right">{{ __('Serie') }}</label>

                                    <div class="col-md-6">
                                        <input id="serie" type="text" class="form-control{{ $errors->has('serie') ? ' is-invalid' : '' }}" name="serie" value="{{ old('serie') }}" required>

                                        @if ($errors->has('serie'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('serie') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="service_tag" class="col-md-4 col-form-label text-md-right">{{ __('Service tag') }}</label>

                                    <div class="col-md-6">
                                        <input id="service_tag" type="text" class="form-control{{ $errors->has('service_tag') ? ' is-invalid' : '' }}" name="service_tag" value="{{ old('service_tag') }}" required>

                                        @if ($errors->has('service_tag'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('service_tag') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="modelo" class="col-md-4 col-form-label text-md-right">{{ __('Modelo') }}</label>

                                    <div class="col-md-6">
                                        <input id="modelo" type="text" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" name="modelo" value="{{ old('modelo') }}" required>

                                        @if ($errors->has('modelo'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('modelo') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0 text-center">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar Accesorio') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection