@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-10">
                </div>
                <a class="btn btn-primary" href="{{ route('empleado')  }}">Atrás</a>
            </div>
            <div class="row">
                <h1>Todos las peticiones de activos aun sin procesar</h1>
                <br>
            </div>
            <div class="row">
                <span class="alert alert-info">Se listan todos los pre resguardos en el sistema. Aquellos que
                    estas por procesar.</span>
                @if(Session::has('success'))
                    <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ Session::get('success') }}</span>
                    </div>
                @endif
                @if(Session::has('Error'))
                    <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ Session::get('Error') }}</span>
                    </div>
                @endif
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Empleado</th>
                <th scope="col">Puesto del empleado</th>
                <th scope="col">Activos</th>
                <th scope="col">Accesorios</th>
                <th scope="col">Fecha de solicitud</th>
                <td scope="col">Acciones</td>
            </tr>
            </thead>
            <tbody>
            @foreach($resguardos as $resguardo)
                <?php $activos_arr =  explode(",", $resguardo->activoGeneral);
                $accesorios_arr =  explode(",", $resguardo->accesorioGeneral);
                $activos_count =  count($activos_arr);
                $accesorios_count = count($accesorios_arr); ?>
                <tr>
                    <td>{{ $resguardo->id }}</td>

                    <!-- buscamos por empleado, el empleado con el id del resguardo -->
                    @foreach($empleados as $empleado)
                        @if($empleado->id == $resguardo->empleadoId)
                            <td>{{ $empleado->nombre }} {{ $empleado->apellidos }}</td>
                            <td>{{ $empleado->puesto }}</td>
                        @endif
                    @endforeach

                    <?php $i = 1; ?>
                    <td>@foreach($activos_arr as $activo_id)
                            @foreach($activos as $activo)
                                @if($activo->id == $activo_id)
                                    {{ $activo->nombre }}
                                    @if($i != $activos_count)
                                        ,
                                    @endif
                                    <?php ++$i?>
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td>
                        <?php $j = 1; ?>
                        @foreach($accesorios_arr as $accesorio_id)
                            @foreach($accesorios as $accesorio)
                                @if($accesorio->id == $accesorio_id)
                                    {{ $accesorio->nombre }}
                                    @if($j != $accesorios_count)
                                        ,
                                    @endif
                                    <?php ++$j?>
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                    <td>{{ explode(" ", $resguardo->created_at)[0] }}</td>

                    <td><a href="" class="btn btn-success">Procesar</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            @if(count($resguardos) <= 0)
                Aun no hay resgistros
            @endif
        </div>
        <div class="row text-center">
        @if(count($resguardos))
            <!--margin top y margin x en class-->
                <div class="mt-2 mx-auto">
                    {{ $resguardos->links('pagination::bootstrap-4')}}
                </div>
            @endif
        </div>
    </div>
@endsection