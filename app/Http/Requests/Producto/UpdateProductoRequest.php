<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:productos,id',
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'precio' => 'sometimes|required|numeric|min:0',
            'cantidad' => 'sometimes|required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'El ID del producto es obligatorio.',
            'id.exists' => 'El producto con el ID proporcionado no existe.',
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'descripcion.required' => 'La descripción del producto es obligatoria.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.min' => 'El precio no puede ser menor que 0.',
            'precio.numeric' => 'El precio debe ser un número.',
            'cantidad.required' => 'La cantidad del producto es obligatoria.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'error' => $validator->errors(),
            'message' => 'Los datos enviados no son válidos.',
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
