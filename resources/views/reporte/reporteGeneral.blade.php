@extends('layouts.app')

@section('content')
    <div>
        <h1>REPORTE GENERAL</h1>
        <p>Reporte de {{ $fecha_del_mes }} hasta {{ $now }}</p>
    </div>
@endsection