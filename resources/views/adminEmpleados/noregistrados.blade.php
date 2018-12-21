@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Solicitudes de empleados no registrados</h1>
        <br><br>
            <p class="alert alert-info">Aquí se encuentran aquellos empleados que han mandado solicitud de registro a la plataforma.
        En esta sección puede revisar, aceptar o rechazar las peticiones.</p>
        <br>
        <div class="row">
            @foreach($noRegistered as $user )
                <div class="col-md-4">
                    <div class="jumbotron jumboColorBlue">
                        <p>Nombre completo: <span class="blue">{{ $user->nombre  }} {{ $user->apellidos  }}</span></p>
                        <p>Correo electrónico: <span class="blue">{{ $user->email  }}</span></p>
                        Tipo de usuario:
                        <span class="blue">
                            @if(!$user->tipo_user)
                                Administrador
                            @elseif($user->tipo_user == 1)
                                Empleado
                            @elseif($user->tipo_user == 2)
                                Técnico
                            @endif
                        </span>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div>
                                <a href="{{ route('denegarEmpleado', $user->id)  }}" class="btn btn-danger">Rechazar</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{ route('aceptarEmpleado', $user->id) }}"
                                   class="btn btn-success">Aceptar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection