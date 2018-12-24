@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('success') }}</span>
            </div>
        @endif
        <div class="row">
            <h1>Todos tus incidentes reportados</h1>
            <span class="alert alert-info">Aquí puedes ver todos los incidentes atendidos y no atendidos por el administrador que
                has reportado al sistema.</span>
        </div>
        <div class="row">
            <div class="col-md-5 jumbotron jumboColorDark left">
                <div class="text-center">
                    <h1>Etiquetados</h1>
                </div>
                <div>
                    @foreach($incidentes as $incidente)
                        @if($incidente->etiquetado)
                            <p>{{ $incidente->caso }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-5 jumbotron jumboColorDark right">
                <div class="text-center">
                    <h1>En cola</h1>
                </div>
                <div>
                    @foreach($incidentes as $incidente)
                        @if(!$incidente->etiquetado)
                            <p>{{ $incidente->caso }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
