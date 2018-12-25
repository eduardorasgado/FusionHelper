@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('incidentesAdminIndex') }}">Atrás</a>
        </div>
        <h1>Ticket #</h1>
        <br><br>
        <p class="alert alert-info"></p>
        <br>
    </div>
@endsection