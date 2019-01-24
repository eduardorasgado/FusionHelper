@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary"
               href="{{ url()->previous() }}">Atrás</a>
        </div>
        <h1>Ticket #{{ $ticket->id }}</h1>
        <br><br>
        <br>
        <div class="row">
            <div class="jumbotron jumboColorBlue col-md-6">
                <p><span class="blue">Caso: </span>{{ $incidente->caso }}</p>
                <p><span class="blue">Reportado por: </span>{{ $empleado->nombre }} {{ $empleado->apellidos }}
                    <span style="padding: 0 5px 0 5px; margin: 0"
                          class="alert @if($empleado->estado == 1) alert-info @else alert-danger @endif">
                    @if($empleado->estado == 1) Activo @else Inactivo @endif</span>
                </p>
                <p><span class="blue">Área: </span> @if(isset($area->nombre)) {{ $area->nombre }} @endif</p>
                <p><span class="blue">Tipo de incidente: </span>@if(isset($tipo->nombre)) {{ $tipo->nombre }} @endif</p>
                <p><span class="blue">Diagnóstico: </span>{{ $incidente->diagnostico }}</p>
                <p><span class="blue">Solución: </span>{{ $incidente->solucion }}</p>
                <p><span class="blue">Descripción del fallo: </span>{{ $incidente->descripcion_fallo }}</p>
                <p><span class="blue">Fecha de registro: </span> {{ $incidente->created_at }}</p>
                <p><span class="blue">Fecha y hora de inicio: </span>{{ $incidente->created_at }}</p>
                <p><span class="blue">Fecha y hora de cierre: </span>{{ $ticket->created_at }}</p>
            </div>
        </div>
    </div>
@endsection