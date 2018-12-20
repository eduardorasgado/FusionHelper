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
                <div class="jumbotron text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Tickets
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Link 1</a>
                            <a class="dropdown-item" href="#">Link 2</a>
                            <a class="dropdown-item" href="#">Link 3</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Incidentes
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">No registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Todos</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Administrar empleados
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('admin/empleados/noregistrados')}}">No registrados</a>
                            <a class="dropdown-item" href="{{url('admin/empleados/registrados')}}">Registrados</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Almacenamiento
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">No registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Todos</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Mantenimiento
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">No registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Todos</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            Reporte
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">No registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Registrados</a>
                            <a class="dropdown-item" href="{{url('registro/tecnico')}}">Todos</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Otras acciones</h2>
        <div class="row">
            <div class="jumbotron col-md-6">
                <a href="{{url('registro/tecnico')}}"><button class="btn btn-danger">Otra accion aqui</button></a></div>
            </div>
        </div>
    </div>
    <div class="container text-right">
        <a href="{{url('registro/tecnico')}}"><button class="btn btn-outline-secondary">Reportar un bug</button></a>
    </div>
@endsection