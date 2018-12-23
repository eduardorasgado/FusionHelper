@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Registro de nuevo tipo de incidente en el sistema</h1>
        <br><br>
        <p class="alert alert-info">Los tipos de incidente son fundamentales para el pertinente registro de los tickets
            en el sistema, así como de los incidentes mismos.</p>
        <br>

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
                        <form method="POST" action="{{ route('tiposIncidenteRegistroPost') }}"
                              onsubmit="return confirm('Va a registrar una nueva área. Está seguro/a?');">
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
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción general del tipo de incidente') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
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
                                        {{ __('Registrar Tipo de Incidente') }}
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