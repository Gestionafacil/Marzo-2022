<?php

namespace GestionaFacil\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class FacturaVentaRequest extends FormRequest
{
    //protected $redirectRoute = 'nuevaFacturaVenta'; //ruta definida en alguno de los archivos de la carpeta routes/
    
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'contacto_id' => 'Contacto',
            'tipo_documento_id' => 'Tipo de documento',
            'arrayFact' => 'Listado de productos',
            'metodo_pago_id' => 'Metódo de pago',
            'forma_pago_id' => 'Forma de pago',
        ];
    }

    public function messages()
    {
        return [
            'contacto_id.required' => 'El :attribute es de caracter obligatorio.',
            'contacto_id.exists' => 'El :attribute no esta registrado en la Base de datos de Gestiona Facil.',
            'tipo_documento_id.required' => 'El :attribute es de caracter obligatorio.',
            'arrayFact.required' => 'El :attribute es de caracter obligatorio.',
            'metodo_pago_id.required' => 'El :attribute es de caracter obligatorio.',
            'metodo_pago_id.exists' => 'El :attribute no esta registrado en la Base de datos de Gestiona Facil.',
            'forma_pago_id.required' => 'El :attribute es de caracter obligatorio.',
            'forma_pago_id.exists' => 'El :attribute no esta registrado en la Base de datos de Gestiona Facil.',
        ];
    }

    public function rules(): array{
        return [
            'contacto_id' => 'required|exists:contactos,id',
            //'tipo_documento_id' => 'required',
            'arrayFact' => 'required',
            'metodo_pago_id' => 'required|exists:descripcion,id',
            'forma_pago_id' => 'required|exists:descripcion,id'
        ];

    }

    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }
        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
