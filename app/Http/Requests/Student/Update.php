<?php

namespace App\Http\Requests\Student;

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
            'name' => [ 'required', 'min:6', 'max:255', ],

            'email' => [ 'required', 'email', 'min:6', 'max:255', 'unique:students,email,'.$this->student->id.',id' ],

            'identification' => [ 'required', 'min:6', 'max:255', 'unique:students,identification,'.$this->student->id.',id' ],

            'typeOfIdentification' => [ 'required', 'min:6', 'max:36', ],
            
            'course' => [ 'required', 'min:6', 'max:36', ],
        ];
    }
}
