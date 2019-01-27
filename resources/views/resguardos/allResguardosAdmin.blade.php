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
                <h1>Todos los resguardos en el sistema</h1>
                <br>
            </div>
            <div class="row">
                <span class="alert alert-info">Se listan todos los resguardos en el sistema. Aquellos que has aprobado y los que no.</span>
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
                <th scope="col">Activos</th>
                <th scope="col">Accesorios</th>
                <th scope="col">Fecha de asignacion</th>
                <th scope="col">Hora de asignacion</th>
                <th scope="col">Fecha de entrega</th>
                <th scope="col">Hora de entrega</th>
                <th scope="col">Aprobar(PDF)</th>
            </tr>
            </thead>
            <tbody>

            @foreach($resguardos as $resguardo)
                <?php $activos_arr =  explode(",", $resguardo->activosId);
                $accesorios_arr =  explode(",", $resguardo->accesoriosId);
                $activos_count =  count($activos_arr);
                $accesorios_count = count($accesorios_arr); ?>
                <tr>
                    <td>{{ $resguardo->id }}</td>
                    <td>
                        @foreach($empleados as $empleado)
                            @if($empleado->id == $resguardo->empleadoId)
                                {{ $empleado-> nombre }} {{ $empleado->apellidos }}
                            @endif
                        @endforeach
                    </td>
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
                    <td>{{ $resguardo->fecha_asignacion }}</td>
                    <td>{{ explode(" ", $resguardo->created_at)[1] }}</td>
                    <td>@if(isset($resguardo->fecha_entrega)) {{ $resguardo->fecha_entrega }} @else sin asignar @endif</td>
                    <td>@if(isset($resguardo->hora_entrega)) {{ $resguardo->hora_entrega }} @else sin asignar @endif</td>
                    <td>@if($resguardo->estado == 0)
                            <a class="btn btn-success" href="{{ route('generateResguardoPDF', $resguardo->id) }}">PDF</a>
                            @else
                            <a class="btn btn-info" href="">Ver PDF</a>
                        @endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
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