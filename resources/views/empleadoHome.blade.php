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
                <div class="jumbotron">
                    <a href="{{ route('incidenteEmpleadoRegistro') }}"><button class="btn btn-success">Reportar un incidente</button></a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="jumbotron">
                    <a href="{{ route('incidentesEmpleadoIndex') }}"><button class="btn btn-success">Ver todos mis incidentes registrados</button></a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="jumbotron">
                    <a href="{{route('empleado')}}"><button class="btn btn-success">Solicitar un activo</button></a>
                </div>
            </div>

        </div>
        <div class="container">
            <a href="{{url('registro/tecnico')}}"><button class="btn btn-outline-secondary">Reportar un bug</button></a>
        </div>
    </div>
    @elseif($authorized == 0)
        <span class="alert alert-warning">Usted aún no ha sido autorizado. Espere la respuesta del administrador.
            En caso de demora, contáctele.</span>
    @else
        <span class="alert alert-danger">Usted fue rechazado. Su cuenta será eliminada en un día.</span>
    @endif
@endsection