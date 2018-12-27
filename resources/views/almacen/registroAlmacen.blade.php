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
                            {{--
                                nombre
                                apellidos
                                telefono
                                email
                                rfc
                                estado
                            --}}
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

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection