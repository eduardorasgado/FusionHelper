@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Empleados Registrados</h1>
        <br><br>
        <p class="alert alert-info">Aquí se encuentran aquellos empleados que están en la plantilla de soporte de sistemas</p>
        @if(Session::has('Error'))
            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        @if(Session::has('userUpdated'))
            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('userUpdated') }}</span>
            </div>
        @endif
        <br>
        <div class="row">
            @foreach($Registered as $user )
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