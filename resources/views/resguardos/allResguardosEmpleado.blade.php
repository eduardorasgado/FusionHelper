@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-10">
                </div>
                <a class="btn btn-primary" href="{{ route('empleado')  }}">Atrás</a>
            </div>
            <div class="row">
                <h1>Todos tus resguardos</h1>
                <br>
            </div>
            <div class="row">
                <span class="alert alert-info">Se listan todos los resguardos a tu nombre en el sistema. Aquellos que tu solicitaste.</span>
                @if(Session::has('success'))
                    <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ Session::get('success') }}</span>
                    </div>
                @endif
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">activos</th>
                <th scope="col">Accesorios</th>
                <th scope="col">Fecha de asignacion</th>
                <th scope="col">Hora de asignacion</th>
                <th scope="col">Fecha de entrega</th>
                <th scope="col">Hora de entrega</th>
            </tr>
            </thead>
            <tbody>

            @foreach($user_resguardos as $resguardo)
                <?php $activos_arr =  explode(",", $resguardo->activosId);
                $accesorios_arr =  explode(",", $resguardo->accesoriosId);
                $activos_count =  count($activos_arr);
                $accesorios_count = count($accesorios_arr); ?>
                <tr>
                    <th scope="row"><a class="btn btn-dark"
                                       href="{{-- route('ticketIndividual', $resguardo->id) --}}">{{ $resguardo->id }}</a></th>
                    <?php $i = 1;?>
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
                        @endforeach</td>
                    <?php $j = 1;?>
                    <td>@foreach($accesorios_arr as $accesorios_id)
                            @foreach($accesorios as $accesorio)
                                @if($accesorio->id == $accesorios_id)
                                    {{ $accesorio->nombre }}
                                    @if($j != $accesorios_count)
                                        ,
                                    @endif
                                    <?php ++$i?>
                                @endif
                            @endforeach
                        @endforeach</td>
                    <td>{{ $resguardo->fecha_asignacion }}</td>
                    <td> {{ explode(" ", $resguardo->created_at)[1] }}</td>
                    <td>@if(isset($resguardo->fecha_entrega)) {{ $resguardo->fecha_entrega }} @else aun sin asignar @endif</td>
                    <td>@if(isset($resguardo->hora_entrega)) {{ $resguardo->hora_entrega }} @else aun sin asignar @endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row text-center">
        @if(count($user_resguardos))
            <!--margin top y margin x en class-->
                <div class="mt-2 mx-auto">
                    {{ $user_resguardos->links('pagination::bootstrap-4')}}
                </div>
            @endif
        </div>
    </div>
@endsection