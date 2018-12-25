@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('incidentesAdminIndex') }}">Atrás</a>
        </div>
        <h1>Registro del ticket del incidente {{ $incidente->id }}</h1>
        <br><br>
        <p class="alert alert-info">La información se toma en automático solo tiene que confirmar el proceso.</p>
        <br>

            <div class="jumbotron  text-center">
                <h3>El incidente es: {{ $incidente->caso }}</h3>
                <a href="{{ route('postTicketRegistroAceptado', $incidente->id) }}" class="btn btn-success">Generar Ticket</a>

    </div>
@endsection