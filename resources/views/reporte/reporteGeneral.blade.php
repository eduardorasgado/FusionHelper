@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>REPORTE GENERAL</h1>
        <p>Reporte de {{ $fecha_del_mes }} hasta {{ $now }}</p>
        <div id="reporter"></div>
    </div>
@endsection