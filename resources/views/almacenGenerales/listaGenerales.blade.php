@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary"
               href="{{ route('admin') }}">Atrás</a>
        </div>
        <h1>Todos los registros de Activos y Accesorios Generales</h1>
        <br><br>
        <br>
    </div>
    <div class="container-fluid">
        <div class="text-center">
            <h3>Activos y accesorios generales</h3>
            <br>
            <span class="alert alert-info">Seleccione el botón correspondiente a su elección.
                Presione el mismo botón para cerrar la tabla en la que se encuentra.</span>
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
            <div class="row text-center">
                {{-- MENSAJES DE SUCCESS DESDE LOS CONTROLLERS DE PROVEEDOR, ACTIVO Y ACCESORIOS--}}
                <div class="col-md-4"></div>
                <p>
                    <a href="#multiCollapse2" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse2">
                        Tabla de Activos Generales
                    </a>&nbsp;&nbsp;
                    <a href="#multiCollapse3" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse3">
                        Tabla de Accesorios Generales
                    </a>
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse2">
                    <div class="card card-header">
                        <h3>Activos Generales</h3>
                    </div>
                    <div class="card card-body">
                        @if(count($activos_generales) == 0)
                            <p>Aún no hay Activos</p>
                        @endif
                        <table class="table">
                            <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th scope="col">Nombre</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activos_generales as $activo)
                                <tr>
                                    <td>{{ $activo->id }}</td>
                                    <td>{{ $activo->nombre }}</td>
                                    <td>
                                        <a class="btn btn-dark"
                                           href=""
                                           onclick="return confirm('Está seguro de querer modificar este activo general?')">Modificar</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"
                                           href=""
                                           onclick="return confirm('Está seguro de querer eliminar este activo general?')">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse3">
                    <div class="card card-header">
                        <h3>Accesorios Generales</h3>
                    </div>
                    <div class="card card-body">
                        @if(count($accesorios_generales) == 0)
                            <p>Aún no hay Accesorios Generales</p>
                        @endif
                        <table class="table">
                            <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th scope="col">Nombre</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accesorios_generales as $accesorio)
                                <tr>
                                    <td>{{ $accesorio->id }}</td>
                                    <td>{{ $accesorio->nombre }}</td>
                                    <td>
                                        <a class="btn btn-dark"
                                           href=""
                                           onclick="return confirm('Está seguro de querer modificar este accesorio?')">Modificar</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"
                                           href=""
                                           onclick="return confirm('Está seguro de querer eliminar este accesorio?')">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection