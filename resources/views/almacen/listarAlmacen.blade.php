@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary"
               href="{{ route('admin') }}">Atrás</a>
        </div>
        <h1>Todos los registros de almacén</h1>
        <br><br>
        <br>
    </div>
    <div class="container-fluid">
        <div class="text-center">
            <h3>Proveedores, activos, accesorios</h3>
            <br>
            <span class="alert alert-info">Seleccione el botón correspondiente a su elección.
                Presione el mismo botón para cerrar la tabla en la que se encuentra.</span>
            <br><br><br>
            @if(Session::has('successProveedor'))
                <div class="alert alert-success" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('successProveedor') }}</span>
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
                    <a href="#multiCollapse1" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse1">
                        Tabla de Proveedores
                    </a> &nbsp;&nbsp;&nbsp;
                    <a href="#multiCollapse2" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse2">
                        Tabla de Activos
                    </a>&nbsp;&nbsp;
                    <a href="#multiCollapse3" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse3">
                        Tabla de Accesorios
                    </a>
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse1">
                    <div class="card card-header">
                        <h3>Proveedores</h3>
                    </div>
                    <div class="card card-body">
                        @if(count($proveedores) == 0)
                            <p>Aún no hay proveedores</p>
                        @endif
                        @foreach($proveedores as $proveedor)
                            <p>{{ $proveedor->nombre }} | {{ $proveedor->apellidos }} | {{ $proveedor->email }}
                                <a class="btn btn-dark"
                                   href="{{ route('updateProveedor', $proveedor->id) }}"
                                    onclick="return confirm('Está seguro de querer modificar este proveedor?')">Modificar</a>
                                <a class="btn btn-danger"
                                   href="{{ route('deleteProveedor', $proveedor->id) }}"
                                   onclick="return confirm('Está seguro de querer eliminar este proveedor?')">Eliminar</a>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse2">
                    <div class="card card-header">
                        <h3>Activos</h3>
                    </div>
                    <div class="card card-body">
                        @if(count($activos) == 0)
                            <p>Aún no hay Activos</p>
                        @endif
                        @foreach($activos as $activo)
                            <p>{{ $activo->nombre }} | {{ $activo->serie }} | {{ $activo->marca }} |
                                {{ $activo->modelo }} | {{ $activo->color }} |
                                <a class="btn btn-dark"
                                   href="{{ route('updateActivo', $activo->id) }}"
                                   onclick="return confirm('Está seguro de querer modificar este activo?')">Modificar</a>
                                <a class="btn btn-danger"
                                   href="{{ route('deleteActivo', $activo->id) }}"
                                   onclick="return confirm('Está seguro de querer eliminar este activo?')">Eliminar</a>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse3">
                    <div class="card card-header">
                        <h3>Accesorios</h3>
                    </div>
                    <div class="card card-body">
                        @if(count($accesorios) == 0)
                            <p>Aún no hay Activos</p>
                        @endif
                        @foreach($accesorios as $accesorio)
                            <p> Nombre: {{ $accesorio->nombre }}
                                | Serie:{{ $accesorio->serie }}
                                | Marca: {{ $accesorio->marca }} |
                                Modelo: {{ $accesorio->modelo }} |
                                @foreach($activos as $activo)
                                    @if($accesorio->activoId == $activo->id)
                                        Activo al que pertenece: {{ $activo->nombre }}
                                    @endif
                                @endforeach
                                <a class="btn btn-dark"
                                   href="{{ route('updateActivo', $accesorio->id) }}"
                                   onclick="return confirm('Está seguro de querer modificar este activo?')">Modificar</a>
                                <a class="btn btn-danger"
                                   href="{{ route('deleteActivo', $accesorio->id) }}"
                                   onclick="return confirm('Está seguro de querer eliminar este activo?')">Eliminar</a>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection