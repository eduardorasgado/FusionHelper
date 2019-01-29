@extends('layouts.app')

@section("content")
    <div class="container">
        <div>
            <h1>Tu area de registros</h1>
            <div>
                <p>Bienvenido a Fusión Electrica del Istmo. Esta es tu mesa de trabajo, ya puedes comenzar a
                    utilizarla. Excelente día</p>
            </div>
        </div>
        @if($authorized == 1)
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="jumbotron jumbo-1">
                    <a href="{{ route('incidenteEmpleadoRegistro') }}"><button class="btn">Reportar un incidente</button></a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="jumbotron jumbo-2">
                    <a href="{{ route('incidentesEmpleadoIndex') }}"><button class="btn">Ver todos mis incidentes registrados</button></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center jumbo-3">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Activos
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('resguardoEmpleadoRegistro')}}">Solicitar un activo</a>
                            <a class="dropdown-item" href="{{route('allResguardosIndividual')}}">Ver mis activos solicitados</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
            <a href=""><button class="btn btn-outline-secondary">Reportar un bug</button></a>
        </div>
    </div>
    @elseif($authorized == 0)
        <span class="alert alert-warning">Usted aún no ha sido autorizado. Espere la respuesta del administrador.
            En caso de demora, contáctele.</span>
    @else
        <span class="alert alert-danger">Esta cuenta está inhabilitada. No puede realizar ninguna acción.</span>
    @endif
@endsection