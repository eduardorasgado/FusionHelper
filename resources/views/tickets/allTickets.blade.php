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
                <th scope="col">#</th>
                <th scope="col">Caso</th>
                <th scope="col">Tipo</th>
                <th scope="col">Area</th>
                <th scope="col">Inicio</th>
                <th scope="col">Cierre</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>sdsfds</td>
                <td>sdsfds</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>dfasd</td>
                <td>dfasd</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                <td>sdfscds</td>
                <td>sdfscds</td>
            </tr>
            </tbody>
        </table>

        <?php $i = 0?>
        @foreach($tickets as $ticket)
            <p>Ticket #{{ $ticket->id }}: {{ $incidentes[$i]->caso }} |
                {{ $empleados[$i] }} | {{ $tipos[$i]->nombre }} | {{ $areas[$i]->nombre }}</p>
            <?php $i++?>
        @endforeach

        @if(count($tickets))
        <!--margin top y margin x en class-->
            <div class="mt-2 mx-auto">
                {{ $tickets->links('pagination::bootstrap-4')}}
            </div>
        @endif
    </div>
@endsection

