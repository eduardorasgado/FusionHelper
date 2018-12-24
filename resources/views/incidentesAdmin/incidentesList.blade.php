@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('admin')  }}">Atrás</a>
        </div>
        <h1>Todos los incidentes en el sistema</h1>
        <br>
        <span class="alert alert-info">Aquí puedes ver todos los incidentes atendidos y no atendidos que
            se han reportado al sistema.</span>
        <br><br><br>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('success') }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-5 jumbotron jumboColorDark left">
                <div class="text-center">
                    <h1>Etiquetados</h1>
                </div>
                <div>
                    @if(!$registradosCount)
                        <br>
                        <div class="text-center">
                            <span class="alert alert-info">Aún no hay ningún incidente en esta lista.</span>
                        </div>
                    @endif
                    @foreach($incidentesRegistrados as $incidente)
                        @if($incidente->etiquetado)
                            <div class="jumbotron jumboBox">
                                <h4><span class="orange">Caso: </span>{{ $incidente->caso }}</h4>
                                <p><span class="orange">Reportado por:</span>
                                    {{ $empleados[$incidente->empleadoId-1]->nombre }}
                                    {{ $empleados[$incidente->empleadoId-1]->apellidos }}
                                </p>
                                <hr style="background-color: white">
                                <p><span class="orange">Tipo: </span>
                                    @if(count($tipos) > 0)
                                        {{-- el tipo de incidente[tipo - 1] debido a que array inicia en 0,
                                         y el primer id del tipo de incidente es 1--}}
                                        {{ $tipos[$incidente->tipo-1]->nombre }}
                                    @endif
                                </p>
                                <p><span class="orange">Prioridad: </span>
                                    @if($incidente->prioridad == 0)
                                        Baja
                                    @elseif($incidente->prioridad == 1)
                                        Media
                                    @elseif($incidente->prioridad == 2)
                                        Alta
                                    @endif
                                </p>
                                <p><span class="orange">Diagnóstico: </span>{{ $incidente->diagnostico }}</p>
                                <p><span class="orange">Solución: </span>{{ $incidente->solucion }}</p>
                                <p><span class="orange">Descripción del fallo: </span>{{ $incidente->descripcion_fallo }}</p>
                                <p><span class="orange">Fecha de registro: </span> {{ $incidente->created_at }}</p>
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-2">
                                        <a href="" class="btn btn-primary">Ver ticket</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-5 jumbotron jumboColorDark right">
                <div class="text-center">
                    <h1>En cola</h1>
                </div>
                <div>
                    @if(!$encolaCount)
                        <br>
                        <div class="text-center">
                            <span class="alert alert-info">Aún no hay ningún incidente en esta lista.</span>
                        </div>
                    @endif
                    @foreach($incidentesEnCola as $incidente)
                        @if(!$incidente->etiquetado)
                            <div class="jumbotron jumboBox">
                                <h4><span class="orange">Caso: </span>{{ $incidente->caso }}</h4>
                                <p><span class="orange">Reportado por:</span>
                                    {{ $empleados[$incidente->empleadoId-1]->nombre }}
                                    {{ $empleados[$incidente->empleadoId-1]->apellidos }}
                                </p>
                                <hr style="background-color: white">
                                <p><span class="orange">Tipo: </span>
                                    @if(count($tipos) > 0)
                                        {{ $tipos[$incidente->tipo-1]->nombre }}
                                    @endif
                                </p>
                                <p><span class="orange">Prioridad: </span>
                                    @if($incidente->prioridad == 0)
                                        Baja
                                    @elseif($incidente->prioridad == 1)
                                        Media
                                    @elseif($incidente->prioridad == 2)
                                        Alta
                                    @endif
                                </p>
                                <p><span class="orange">Diagnóstico: </span>{{ $incidente->diagnostico }}</p>
                                <p><span class="orange">Solución: </span>{{ $incidente->solucion }}</p>
                                <p><span class="orange">Descripción del fallo: </span>{{ $incidente->descripcion_fallo }}</p>
                                <p><span class="orange">Fecha de registro: </span> {{ $incidente->created_at }}</p>
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-2">
                                        <a href="" class="btn btn-primary">Crear ticket</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
