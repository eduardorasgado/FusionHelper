@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>

        <h1>Todos los Tickets</h1>
        <br>
        <div>
            <span class="alert alert-info">Se listan todos los tickets en el sistema.</span>
        </div>
        <br><br><br>

        <div class="row">
            <label class="col-md-1 col-form-label" for="search">Filtrar</label>
            <input class="form-control col-md-6" id="search"  type="text">
        </div>
        <br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Ticket</th>
                <th scope="col">Caso</th>
                <th scope="col">Tipo</th>
                <th scope="col">Area</th>
                <th scope="col">Reportado por</th>
                <th scope="col">Reportado</th>
                <th scope="col">Etiquetado</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0?>

            @foreach($tickets as $ticket)
                <tr>
                    <th scope="row"><a class="btn btn-dark"
                                       href="{{ route('ticketIndividual', $incidentes[$i]->id) }}">{{ $ticket->id }}</a></th>
                    <td>{{ $incidentes[$i]->caso }}</td>
                    <td>{{ $tipos[$i]->nombre }}</td>
                    <td>{{ $areas[$i]->nombre }}</td>
                    <td>{{ $empleados[$i] }}</td>
                    <td>{{ $incidentes[$i]->created_at }}</td>
                    <td>{{ $ticket->created_at }}</td>
                </tr>
                <?php $i++?>
            @endforeach
            </tbody>
        </table>

        <div class="row text-center">
            @if(count($tickets))
            <!--margin top y margin x en class-->
                <div class="mt-2 mx-auto">
                    {{ $tickets->links('pagination::bootstrap-4')}}
                </div>
            @endif
        </div>
    </div>
@endsection

