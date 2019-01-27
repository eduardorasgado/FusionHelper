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
                <tr>
                    <td>{{ $resguardo->id }}</td>
                    <td>saf</td>
                    <td>sadf</td>
                    <td>asda</td>
                    <td>sdas</td>
                    <td>sdas</td>
                    <td>sdas</td>
                    <td>sdas</td>
                    <td>@if($resguardo->estado == 0)
                            <a class="btn btn-success" href="">PDF</a>
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