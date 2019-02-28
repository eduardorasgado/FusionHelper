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
                    <h3>Asignacion de Activo/Accesorio</h3>
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
                    @if(Session::has('success'))
                        <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                            <span class="text-success">{{ Session::get('success') }}</span>
                        </div>
                    @endif
                </div>
                <div class="jumbotron jumboBox">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Empleado:</h4>
                            <p>{{ $empleado->nombre }} {{ $empleado->apellidos }}</p>
                            <h4>Puesto:</h4>
                            <p>{{ $empleado->puesto }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Solicitud</h4>
                            <h5>Activos:</h5>
                                <ul>
                                    @foreach($activosGeneral as $activoGeneral)
                                        <li>{{ $activoGeneral->nombre }}</li>
                                    @endforeach
                                </ul>
                            <h5>Accesorios:</h5>
                                <ul>
                                    @foreach($accesoriosGeneral as $accesorioGeneral)
                                        <li>{{ $accesorioGeneral->nombre }}</li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="card card-body">
                        <form action="{{ route('resguardoRegistro', $preresguardo->id) }}"
                              method="POST" onsubmit="return confirm('Está seguro de hacer este registro?')">
                            @csrf
                            <div class="form-group row">
                                <h3>Activos</h3>
                                <label for="activosId[]" class="col-md-2 col-form-label text-md-right">{{ __('Seleccione Activos') }}</label>
                                <select multiple class="form-control col-md-8" id="activosId[]" name="activosId[]"
                                        size="@if(count($activos)>14) 15 @endif">
                                    @foreach ($activos as $activo)
                                        <option value="{{ $activo->id }}">{{ $activo->nombre }} |
                                            marca: {{ $activo->marca }} | modelo: {{ $activo->modelo }} | color: {{ $activo->color }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">

                                <label for="accesoriosId[]" class="col-md-2 col-form-label text-md-right">{{ __('Seleccione accesorios(si es necesario)') }}</label>
                                <select multiple class="form-control col-md-8" id="accesoriosId[]" name="accesoriosId[]"
                                        size="@if(count($accesorios)>9) 10 @endif">
                                    @foreach($activos as $activo)
                                        @foreach ($accesorios as $accesorio)
                                            @if($accesorio->activoId == $activo->id)
                                                <option value="{{ $accesorio->id }}">{{ $accesorio->nombre }} |
                                                    serie: {{ $accesorio->serie }} | Marca: {{ $accesorio->service_tag }}
                                                    | Activo perteneciente: {{ $activo->nombre }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @foreach ($accesorios as $accesorio)
                                        @if($accesorio->activoId == null)
                                            <option value="{{ $accesorio->id }}">{{ $accesorio->nombre }} |
                                                serie: {{ $accesorio->serie }} | Marca: {{ $accesorio->service_tag }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row mb-0 text-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Asignar') }}
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