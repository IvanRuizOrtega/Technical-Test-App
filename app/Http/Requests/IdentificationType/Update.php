<?php

namespace App\Http\Requests\IdentificationType;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [ 'required', 'min:6', 'max:255', 'unique:identification_types,name,'.$this->identification_type->id.',id' ],
        ];
    }
}