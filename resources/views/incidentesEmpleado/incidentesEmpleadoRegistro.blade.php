@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('empleado')  }}">Atrás</a>
        </div>
        <h1>Registro de un incidente </h1>
        <br><br>
        <p class="alert alert-info">Registre un nuevo incidente, este será procesado por el administrador.</p>
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif

        <br>
        <div class="row">
            <div class="card-body">
                <form method="POST" action="{{ route('incidenteEmpleadoRegistro') }}"
                      onsubmit="return confirm('Está seguro/a de esta acción?');">
                    @csrf

                    <div class="form-group row">
                        <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Área') }}</label>
                        <select class="form-control col-md-6" id="area" name="area">
                            <option value="">Seleccione un área</option>
                            @foreach ($areas as $area)
                                @if($area->estado)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="prioridad" class="col-md-4 col-form-label text-md-right">{{ __('Prioridad') }}</label>
                        <select class="form-control col-md-6" id="prioridad" name="prioridad">
                            <option value="">Seleccione prioridad</option>
                            <option value="0">Baja</option>
                            <option value="1">Media</option>
                            <option value="2">Alta</option>
                        </select>
                    </div>

                    @if(Auth::user()->tipo_user == 0)
                        <div class="form-group row">
                            <label for="empleadoId" class="col-md-4 col-form-label text-md-right">{{ __('Empleado') }}</label>
                            <select class="form-control col-md-6" id="empleadoId" name="empleadoId">
                                <option value="">Seleccione el empleado</option>
                                @foreach($empleados as $empleado)

                                    <option value="{{ $empleado->id}}">{{ $empleado->nombre}} {{ $empleado->apellidos }}</option>

                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="caso" class="col-md-4 col-form-label text-md-right">{{ __('Caso') }}</label>

                        <div class="col-md-6">
                                    <textarea id="caso" type="text" class="form-control{{ $errors->has('caso') ? ' is-invalid' : '' }}" name="caso" value="{{ old('caso') }}" required autofocus>
                                    </textarea>

                            @if ($errors->has('caso'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('caso') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reportar el incidente') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection