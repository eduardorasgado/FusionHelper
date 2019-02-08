@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary"
               href="{{ route('admin') }}">Atrás</a>
        </div>
        <h1>Registros de generales de almacen</h1>
        <br><br>
        <br>
    </div>
    <div class="container-fluid">
        <div class="text-center">
            <h3>Formularios de registro</h3>
            <br>
            <div class="jumbotron">
                <p>Los registros generales son indispensables para que el empleado pueda realizar la solicitud de determinados
                    activos o accesorios a requerir.</p>
                <p><span class="badge badge-info">Ejemplos de activo general:</span> Computadora de Escritorio, Laptop, Impresora, Radio, etc.</p>
                <p><span class="badge badge-info">Ejemplos de accesorio general:</span> Mouse, Teclado, cargado de laptop, cargador de computadora, mochila, usb, etc.</p>
                <span class="alert alert-info">Seleccione el botón correspondiente a su elección para el registro deseado.
                Presione el mismo botón para cancelar registro.</span>
            </div>
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
                        Activo General
                    </a> &nbsp;&nbsp;&nbsp;
                    <a href="#multiCollapse2" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse2">
                        Accesorio General
                    </a>
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse1">
                    <div class="card card-header">
                        <h3>Registro de Activo General</h3>
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

                            <div class="form-group row mb-0 text-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar Activo Gral') }}
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
                        <h3>Registro de Accesorio General</h3>
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

                                <div class="form-group row mb-0 text-center">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar Accesorio Gral') }}
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