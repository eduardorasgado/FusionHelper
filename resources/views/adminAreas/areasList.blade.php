@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todas las áreas</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver las áreas existentes de las que dependen los tickets.</p>
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
        @if(count($todasAreas) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay áreas registradas.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('areaRegistro')}}">Registrar un área</a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($todasAreas as $area)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre completo: <span class="blue">daf</span></p>
                            <p>Correo electrónico: <span class="blue">adfs</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div>
                                    <a onclick="return confirm('Está seguro/a de esta acción?');"
                                       href="{{ route('deleteEmpleado', $user->id)  }}" class="btn btn-danger">Eliminar</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('getUpdateEmpleado', $user->id)  }}" class="btn btn-success">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach

        </div>
    </div>
@endsection