@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('listarAlmacen')  }}">Atrás</a>
        </div>
        <h1>Actualizar el activo: {{ $activo->nombre }} </h1>
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
                <form action="{{ route('postUpdateActivo', $activo->id) }}"
                      method="POST" onsubmit="return confirm('Está seguro de hacer este cambio?')">
                    @csrf
                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $activo->nombre }}" required autofocus>

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
                            <input id="serie" type="text" class="form-control{{ $errors->has('serie') ? ' is-invalid' : '' }}" name="serie" value="{{ $activo->serie }}" required autofocus>

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
                            <input id="etiqueta" type="text" class="form-control{{ $errors->has('etiqueta') ? ' is-invalid' : '' }}" name="etiqueta" value="{{ $activo->etiqueta }}" required>

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
                            <input id="marca" type="text" class="form-control{{ $errors->has('marca') ? ' is-invalid' : '' }}" name="marca" value="{{ $activo->marca }}" required>

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
                            <input id="modelo" type="text" class="form-control{{ $errors->has('modelo') ? ' is-invalid' : '' }}" name="modelo" value="{{ $activo->modelo }}" required>

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
                            <input id="color" type="text" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" value="{{ $activo->color }}" required>

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
                                                  name="descripcion" value="" required>{{ $activo->descripcion }}</textarea>

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

@endsection