@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('incidentesAdminIndex') }}">Atrás</a>
        </div>
        <h1>Registro del ticket del incidente {{ $incidente->id }}</h1>
        <br><br>
        <br>
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif

            <div class="jumbotron  text-center">
                <h3>El incidente es: {{ $incidente->caso }}</h3>
            </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Rellene aqui los datos del ticket a generar') }}</div>
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
                        <form method="POST" action="{{ route('postTicketRegistroAceptado', $incidente->id) }}"
                              onsubmit="return confirm('Va a registrar un ticket nuevo. Está seguro/a?');">
                            @csrf

                            @csrf

                            <div class="form-group row">
                                <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de incidente') }}</label>
                                <div class="col-md-6">

                                    <select class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" id="tipo" name="tipo" required>
                                        <option value="">Seleccione un tipo de incidente</option>
                                        @foreach ($tipos as $tipo)
                                            @if($tipo->estado)
                                                {{-- Solo si el estado del tipo es activo este es elegible--}}
                                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('tipo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="diagnostico" class="col-md-4 col-form-label text-md-right">{{ __('Diagnóstico') }}</label>

                                <div class="col-md-6">
                                    <textarea id="diagnostico" type="text" class="form-control{{ $errors->has('diagnostico') ? ' is-invalid' : '' }}" name="diagnostico" value="{{ old('diagnostico') }}" required autofocus>
                                    </textarea>

                                    @if ($errors->has('diagnostico'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('diagnostico') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="solucion" class="col-md-4 col-form-label text-md-right">{{ __('Solución') }}</label>

                                <div class="col-md-6">
                                    <textarea id="solucion" type="text" class="form-control{{ $errors->has('solucion') ? ' is-invalid' : '' }}" name="solucion" value="{{ old('solucion') }}" required autofocus>
                                    </textarea>

                                    @if ($errors->has('solucion'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('solucion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcion_fallo" class="col-md-4 col-form-label text-md-right">{{ __('Descripción del fallo') }}</label>

                                <div class="col-md-6">
                                    <textarea id="descripcion_fallo" type="text" class="form-control{{ $errors->has('descripcion_fallo') ? ' is-invalid' : '' }}" name="descripcion_fallo" value="{{ old('descripcion_fallo') }}" required autofocus>
                                    </textarea>

                                    @if ($errors->has('descripcion_fallo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion_fallo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Generar el ticket') }}
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