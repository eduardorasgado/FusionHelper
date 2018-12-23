@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todas los tipos de Incidente</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver los tipos de incidente existente de las que dependen los incidentes.</p>
        <br>
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ session('success') }}</span>
            </div>
        @endif
        @if(count($allTiposIncidente) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay tipos de incidente registrados.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{ route('/tipoincidente/registro') }}">Registrar un tipo de incidente</a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($allTiposIncidente as $tipo)
                <div class="col-md-4">
                    <div class="jumbotron jumboColorBlue">
                        <p>Nombre: <span class="blue">{{ $tipo->nombre }}</span></p>
                        <p>Descripción: <span class="blue">{{ $tipo->descripcion }}</span></p>
                        <p>Estado: <span class="blue">@if($tipo->estado) Activo @else Desactivado @endif</span></p>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div>
                                <a onclick="return confirm('Está seguro/a de esta acción?');"
                                   href="{{ route('deleteTipoIncidente', $tipo->id) }}" class="btn btn-danger">Eliminar</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="" class="btn btn-success">Modificar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection