<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'telefono' => ['required', 'max:100'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // para crear el administrado debemos comprobar que es el
        // primero en registrarse
        // TODO: CREAR LA OPCION DE TECNICO EN EL REGISTRO

        $tipo = User::EMPLEADO_TYPE;
        $estadoActual = User::INACTIVE;
        if(!User::count()) {
            $tipo = User::ADMIN_TYPE;
            $estadoActual = User::ACTIVE;
        }

        $phone = isset($data['telefono']) ? $data['telefono']: 00;
        $domicilio = isset($data['domicilio']) ? $data['domicilio'] : User::DEFAULT_STRING;
        $puesto = isset($data['puesto']) ? $data['puesto'] : User::DEFAULT_STRING;
        $rfc = isset($data['rfc']) ? $data['rfc'] : User::DEFAULT_STRING;

        return User::create([
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo_user' => $tipo,
            'estado' => $estadoActual,
            'telefono' => $phone,
            'domicilio' => $domicilio,
            'puesto' => $puesto,
            'rfc' => $rfc
        ]);
    }
}
