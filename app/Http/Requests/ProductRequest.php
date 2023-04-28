<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $validate =
            [
                'title'             => "required|string|max:255",
                'description'       => 'required',
                'slug'              => 'sometimes|required',
                'quantity'          => 'required|integer',
                'category_id'          => 'required|integer',
            'price'             => 'required|numeric', //add double
                'discount'         => 'sometimes|required|numeric', //add double
            ];



        return $validate;
    }
}