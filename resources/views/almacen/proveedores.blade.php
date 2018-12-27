@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary"
               href="{{ route('admin') }}">Atrás</a>
        </div>
        <h1>Proveedores</h1>
        <br><br>
        <br>
    </div>
    <div class="container-fluid">
        <div class="text-center">
            <h3>Formularios de registro</h3>
            <br>
            <span class="alert alert-info">Seleccione el botón correspondiente a su elección para el registro deseado.</span>
            <br><br><br>
            <div class="row text-center">
                <div class="col-md-5"></div>
                <p>
                    <a href="#multiCollapse1" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse1">
                        Proveedor
                    </a> &nbsp;&nbsp;&nbsp;
                    <a href="#multiCollapse2" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse2">
                        Activo
                    </a>&nbsp;&nbsp;
                    <a href="#multiCollapse3" class="btn btn-primary" data-toggle="collapse"
                       role="button" aria-expanded="false" aria-controls="multiCollapse3">
                        Accesorio
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse1">
                    <div class="card card-header">
                        <h3>Registro de Proveedor</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse2">
                    <div class="card card-header">
                        <h3>Registro de Activo</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapse3">
                    <div class="card card-header">
                        <h3>Registro de Accesorio</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection