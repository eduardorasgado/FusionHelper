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
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Reportar un incidente</button></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="jumbotron">
                    <a href="{{url('registro/tecnico')}}"><button class="btn btn-success">Solicitar un activo</button></a></div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="{{url('registro/tecnico')}}"><button class="btn btn-outline-secondary">Reportar un bug</button></a></div>
        </div>
    </div>
@endsection