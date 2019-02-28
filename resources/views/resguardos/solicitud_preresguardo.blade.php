@extends("layouts.app")

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-10">

            </div>
            <a class="btn btn-primary" href="{{ route('empleado')  }}">Atrás</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-header">
                    <h3>Solicitud de Activo/Accesorio</h3>
                    <span class="alert alert-info">
                        Instrucciones: <br>
                        Seleccione sus activos o activo, Ctrl + Click derecho en cada uno de los activos/Accesorios que desea. <br>
                        Vuelva a hacer click para deseleccionar el elemento. <br>
                    </span>
                    @if(Session::has('Error'))
                        <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                            <span class="text-success">{{ Session::get('Error') }}</span>
                        </div>
                    @endif
                </div>
                <div class="card card-body">
                    <div class="card card-body">
                        <form action="{{ route('PreresguardoEmpleadoRegistro') }}"
                              method="POST" onsubmit="return confirm('Está seguro de hacer este registro?')">
                            @csrf

                            @if(isset($empleados))
                                <div class="form-group row">
                                    <label for="empleado" class="col-md-2 col-form-label text-md-right">{{ __('Seleccione Empleados') }}</label>
                                    <select class="form-control col-md-8" id="empleado" name="empleado"
                                            >
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->apellidos }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="activosId[]" class="col-md-2 col-form-label text-md-right">{{ __('Seleccione Activos') }}</label>
                                <select multiple class="form-control col-md-8" id="activosId[]" name="activosId[]"
                                        size="@if(count($activos)>14) 15 @endif">
                                    @foreach ($activos as $activo)
                                        <option value="{{ $activo->id }}">{{ $activo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">

                                <label for="accesoriosId[]" class="col-md-2 col-form-label text-md-right">{{ __('Seleccione accesorios(si es necesario)') }}</label>
                                <select multiple class="form-control col-md-8" id="accesoriosId[]" name="accesoriosId[]"
                                        size="@if(count($accesorios)>9) 10 @endif">
                                    @foreach ($accesorios as $accesorio)
                                        <option value="{{ $accesorio->id }}">{{ $accesorio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row mb-0 text-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Solicitar') }}
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