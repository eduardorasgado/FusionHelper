@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('listarAlmacen')  }}">Atrás</a>
        </div>
        <h1>Actualizar el Proveedor {{ $proveedor->nombre }} {{ $proveedor->apellidos  }} </h1>
        <br><br>
        <p class="alert alert-info"></p>
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif

        <br>
        <div class="row">
            <div class="card-body">
                <form method="POST" action="{{ route('postUpdateProveedor', $proveedor->id) }}"
                      onsubmit="return confirm('Está seguro/a de esta acción?');">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la empresa') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $proveedor->nombre }}" required autofocus>

                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Número telefónico') }}</label>

                        <div class="col-md-6">
                            <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $proveedor->telefono }}" required>

                            @if ($errors->has('telefono'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $proveedor->email }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

                        <div class="col-md-6">
                            <input id="rfc" type="text" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc" value="{{ $proveedor->rfc }}" required>

                            @if ($errors->has('rfc'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rfc') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar cambios en el proveedor') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection