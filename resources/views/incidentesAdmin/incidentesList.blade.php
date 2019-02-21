@extends('layouts.app')

@section('content')
    <div class="container-fluid">

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
        @if(Session::has('Error'))
            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 jumbotron jumboColorDark">
                <div class="text-center">
                    <h1>Etiquetados</h1>
                    <span class="alert alert-info">Ordenados del incidente con ticket más reciente al más antiguo</span>
                    <div class="row text-center">
                        @if($registradosCount)
                            <div class="mt-2 mx-auto">
                            {{-- Esto permite la paginacion de dos tablas en una misma view--}}
                            {{$incidentesRegistrados->appends(['page1' => $incidentesRegistrados->currentPage(),
                            'page2' => $incidentesEnCola->currentPage()])
                            ->links()}}
                            </div>
                        @endif
                    </div>
                    <hr style="background-color: #1b4b72">
                </div>
                <div class="div-listado">
                    @if(!$registradosCount)
                        <br>
                        <div class="text-center">
                            <span class="alert alert-info">Aún no hay ningún incidente en esta lista.</span>
                        </div>
                    @endif
                    @foreach($incidentesRegistrados as $incidente)
                        @foreach($tickets as $ticket)
                                @if($ticket->incidenteId == $incidente->id)
                                    <div class="jumbotron jumboBox">
                                        <h4><span class="orange">Caso: </span>{{ $incidente->caso }}</h4>
                                        <p><span class="orange">Reportado por:</span>
                                            @foreach($empleados as $empleado)
                                                @if($empleado->id == $incidente->empleadoId)
                                                    {{ $empleado->nombre }} {{ $empleado->apellidos }}
                                                @endif
                                            @endforeach
                                        </p>
                                        <hr style="background-color: white">
                                        <p><span class="orange">Área: </span>
                                            @if(count($areas) > 0)
                                                @foreach($areas as $area)
                                                    @if($area->id == $incidente->area)
                                                        {{ $area->nombre }}
                                                        @endif
                                                @endforeach
                                            @endif
                                        </p>

                                        <p><span class="orange">Tipo: </span>
                                            @if(count($tipos) > 0)
                                                @foreach($tipos as $tipo)
                                                    @if($tipo->id == $ticket->tipo)
                                                        {{ $tipo->nombre }}
                                                    @endif
                                                @endforeach
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
                                        <p><span class="orange">Diagnóstico: </span>{{ $ticket->diagnostico }}</p>
                                        <p><span class="orange">Solución: </span>{{ $ticket->solucion }}</p>
                                        <p><span class="orange">Descripción del fallo: </span>{{ $ticket->descripcion_fallo }}</p>
                                        <p><span class="orange">Fecha de generacion del ticket: </span> {{ $ticket->created_at }}</p>

                                        <div class="row">
                                            <div class="col-md-8"></div>
                                            <div class="col-md-2">
                                                <a href="{{ route('ticketIndividual', $ticket->id) }}" class="btn btn-primary">Ver ticket</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 jumbotron jumboColorDark">
                <div class="text-center">
                    <h1>En cola</h1>
                    <span class="alert alert-info">Ordenados del incidente más antiguo al más reciente</span>
                    <div class="row text-center">
                        <div class="mt-2 mx-auto">
                        @if($encolaCount)
                                {{$incidentesEnCola->appends(['page1' => $incidentesRegistrados->currentPage(),
                                'page2' => $incidentesEnCola->currentPage()])
                                ->links()}}
                        @endif
                        </div>
                    </div>
                    <hr style="background-color: #1b4b72">
                </div>
                <div class="div-listado">
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
                                    @foreach($empleados as $empleado)
                                        @if($empleado->id == $incidente->empleadoId)
                                            {{ $empleado->nombre }} {{ $empleado->apellidos }}
                                        @endif
                                    @endforeach
                                </p>
                                <hr style="background-color: white">
                                <p><span class="orange">Área: </span>
                                    @if(count($areas) > 0)
                                        @foreach($areas as $area)
                                            @if($area->id == $incidente->area)
                                                {{ $area->nombre }}
                                            @endif
                                        @endforeach
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
                                <p><span class="orange">Fecha de reporte de incidente: </span> {{ $incidente->created_at }}</p>
                                <div class="row">
                                    <div class="col-md-8"></div>
                                    <div class="col-md-2">
                                        <a href="{{ route('getTicketRegistro', $incidente->id) }}" class="btn btn-primary">Crear ticket</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4 offset-2">
                @if($registradosCount)
                    <div class="mt-2 mx-auto">
                        {{-- Esto permite la paginacion de dos tablas en una misma view--}}
                        {{$incidentesRegistrados->appends(['page1' => $incidentesRegistrados->currentPage(),
                        'page2' => $incidentesEnCola->currentPage()])
                        ->links()}}
                    </div>
                @endif
            </div>
            <div class="col-md-6 align-items-center">
                <div class="mt-2 mx-auto">
                    @if($encolaCount)
                        {{$incidentesEnCola->appends(['page1' => $incidentesRegistrados->currentPage(),
                        'page2' => $incidentesEnCola->currentPage()])
                        ->links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
