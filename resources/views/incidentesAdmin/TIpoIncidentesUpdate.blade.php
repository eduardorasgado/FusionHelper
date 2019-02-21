@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/tipoincidente">Atrás</a>
        </div>
        <h1>Actualizacion del tipo de incidente con id: {{ $t_incidente->id }}</h1>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Area de registro de tipo de incidentes') }}</div>
                    @if(Session::has('Error'))
                        <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                            <span class="text-success">{{ Session::get('Error') }}</span>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert" style="margin-top: 5px">
                            <span class="text-success">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('updateTipoIncidentePost', $t_incidente->id) }}"
                              onsubmit="return confirm('Va a cambiar el tipo de incidente actual. Está seguro/a?');">
                            @csrf

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $t_incidente->nombre }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción general del tipo de incidente') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descripcion" type="text"
                                              class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}"
                                              name="descripcion" required autofocus>{{ $t_incidente->descripcion }}
                                    </textarea>

                                    @if ($errors->has('descripcion'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection