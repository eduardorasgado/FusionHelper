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
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Todos los tickets</button></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Administrar empleados</button></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Registrar incidentes disponibles</button></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Almacenamiento</button></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Mantenimiento</button></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="jumbotron text-center">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Almacenamiento</button></a></div>
            </div>
        </div>
    </div>
    <div class="container">
        <a href="{{url('registro/tecnico')}}"><button class="btn btn-outline-secondary">Reportar un bug</button></a>
    </div>
@endsection