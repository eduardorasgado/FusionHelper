<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // si el usuario es un administrador entonces
        // se autoriza
        if(!Auth::user()->tipo_user)
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // valida los campos de las areas
        // ojo, estos campos deben de llamarse igual en el form
        // del frontend y tambien en la base de datos
        return [
            'clave_area' => 'required|string|unique:areas|max:100',
            'nombre' => 'required|string|max:150'
        ];
    }
    // En caso de requerir personalizar los mensajes podemos
    // seguir la documentacion:
    // https://laravel.com/docs/5.7/validation
}
