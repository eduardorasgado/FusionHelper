@extends('layouts.app')

@section("content")
    <div class="container">
        <div>
            <h1>Administrador</h1>
            <div>
                <p>Bienvenido a Fusión Electrica del Istmo. Esta es tu mesa de trabajo, ya puedes comenzar a
                    utilizarla. Excelente día</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="jumbotron jumbo-1 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Incidentes y Tickets
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('incidentesAdminIndex')}}">Incidentes</a>
                            <a class="dropdown-item" href="{{ route('getAllTickets') }}">Tickets</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('incidenteEmpleadoRegistro') }}">Agregar un incidente</a>
                            <a class="dropdown-item" href="{{ route('incidentesEmpleadoIndex') }}">Mis incidentes registrados</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('tiposIncidenteRegistro') }}">Agregar tipo de incidente</a>
                            <a class="dropdown-item" href="{{ route('tiposIncidente') }}">Ver tipos de incidente</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="jumbotron jumbo-2 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Administrar empleados
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('admin/empleados/noregistrados')}}">No registrados</a>
                            <a class="dropdown-item" href="{{url('admin/empleados/registrados')}}">Registrados</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="jumbotron jumbo-3 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Áreas
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('areaRegistro')}}">Registrar un área</a>
                            <a class="dropdown-item" href="{{route('areaIndex')}}">Todas las áreas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="jumbotron jumbo-4 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Almacén
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('registros') }}">Registros de almacén</a>
                            <a class="dropdown-item" href="{{ route('listarAlmacen') }}">Listas de activos, accesorios y proveedores</a>
                            <a class="dropdown-item" href="{{ route('listarReguardosAdmin') }}">Resguardos</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="jumbotron jumbo-5 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" disabled>
                            Reporte
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Generar reporte del mes</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Otras acciones</h2>
        <div class="row">
            <div class="jumbotron col-md-6">
                <a href=""><button class="btn btn-success" disabled>
                        Otra tarea aqui</button></a></div>
            </div>
        </div>
    </div>
    <div class="container text-right">
        <a href=""><button class="btn btn-outline-secondary">Reportar un bug</button></a>
    </div>
@endsection