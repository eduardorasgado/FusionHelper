@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('listarAlmacen')  }}">Atrás</a>
        </div>
        <h1>Actualizar el accesorio: {{ $accesorio->nombre }} </h1>
        <br><br>
        <p class="alert alert-info"></p>
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        <br>

        <div class="row">
            <div class="card card-body">
                <div class="card card-body">
                    <form action="{{ route('postUpdateAccesorio', $accesorio->id) }}"
                          method="POST" onsubmit="return confirm('Está seguro de hacer este cambio?')">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $accesorio->nombre }}" required autofocus>

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
                                <option value="">Seleccione un activo</option>
                                @foreach ($activos as $activo)
                                    <option value="{{ $activo->id }}"
                                            @if($activo->id ==$accesorio->activoId) selected @endif>
                                        {{ $activo->nombre }} |
                                        marca: {{ $activo->marca }} | modelo: {{ $activo->modelo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="serie" class="col-md-4 col-form-label text-md-right">{{ __('Serie') }}</label>

                            <div class="col-md-6">
                                <input id="serie" type="text" class="form-control{{ $errors->has('serie') ? ' is-invalid' : '' }}" name="serie" value="{{ $accesorio->serie }}" required>

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
                                <input id="service_tag" type="text" class="form-control{{ $errors->has('service_tag') ? ' is-invalid' : '' }}" name="service_tag" value="{{ $accesorio->service_tag }}" required>

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
                                <input id="modelo" type="text" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" name="modelo" value="{{ $accesorio->modelo }}" required>

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

@endsection