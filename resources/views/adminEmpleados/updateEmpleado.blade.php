@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="{{ route('empleadosRegistrado')  }}">Atrás</a>
        </div>
        <h1>Actualizar el perfil de {{ $user->nombre }} {{ $user->apellidos  }} </h1>
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
                <form method="POST" action="{{ route('postUpdateEmpleado', $user->id) }}"
                      onsubmit="return confirm('Está seguro/a de esta acción?');">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $user->nombre }}" required autofocus>

                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                        <div class="col-md-6">
                            <input id="apellido" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ $user->apellidos }}" required autofocus>

                            @if ($errors->has('apellidos'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Número telefónico') }}</label>

                        <div class="col-md-6">
                            <input id="telefono" type="number" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $user->telefono }}" required>

                            @if ($errors->has('telefono'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="domicilio" class="col-md-4 col-form-label text-md-right">{{ __('Domicilio') }}</label>

                        <div class="col-md-6">
                            <input id="domicilio" type="text" class="form-control{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" name="domicilio" value="{{ $user->domicilio }}" required>

                            @if ($errors->has('domicilio'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('domicilio') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="puesto" class="col-md-4 col-form-label text-md-right">{{ __('Puesto') }}</label>

                        <div class="col-md-6">
                            <input id="puesto" type="text" class="form-control{{ $errors->has('puesto') ? ' is-invalid' : '' }}" name="puesto" value="{{ $user->puesto }}" required>

                            @if ($errors->has('puesto'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('puesto') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="form-check">
                            <input class=" form-check-input {{ $errors->has('tecnico') ? ' is-invalid' : '' }}"
                                   type="checkbox" name="tecnico" value="2" id="tecnico" @if($user->tipo_user == 2) checked @endif>
                            <label class="form-check-label text-md-right" for="tecnico">
                                {{ __('Personal Técnico') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rfc" class="col-md-4 col-form-label text-md-right">{{ __('RFC') }}</label>

                        <div class="col-md-6">
                            <input id="rfc" type="text" class="form-control{{ $errors->has('rfc') ? ' is-invalid' : '' }}" name="rfc" value="{{ $user->rfc }}" required>

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
                                {{ __('Guardar cambios') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection