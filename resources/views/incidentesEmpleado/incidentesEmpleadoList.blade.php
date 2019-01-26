@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('empleado')  }}">Atrás</a>
        </div>
        <h1>Todos tus incidentes reportados</h1>
        <br>
        <span class="alert alert-info">Aquí puedes ver todos los incidentes atendidos y no atendidos por el administrador que
            has reportado al sistema.</span>
        <br><br><br>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('success') }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 jumbotron jumboColorDark">
                <div class="text-center">
                    <h1>Completos</h1>
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
                </div>

                <div>
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
                                        <p><span class="orange">Fecha de registro: </span> {{ $ticket->created_at }}</p>

                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                </div>
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
            </div>

            <div class="col-md-6 jumbotron jumboColorDark">
                <div class="text-center">
                    <h1>En cola</h1>
                    <span class="alert alert-info">Ordenados del incidente reportado más reciente al más antiguo</span>
                    <div class="row text-center">
                        <div class="mt-2 mx-auto">
                            @if($encolaCount)
                                {{$incidentesEnCola->appends(['page1' => $incidentesRegistrados->currentPage(),
                                'page2' => $incidentesEnCola->currentPage()])
                                ->links()}}
                            @endif
                        </div>
                    </div>
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
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row text-center">
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
    </div>
@endsection
