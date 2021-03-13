<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'period'   => [ 'required', 'min:1', 'max:255', ],            

            'subject'  => [ 'required', 'min:1', 'max:255', ],

            'note'     => [ 'required', 'min:0', 'max:5', 'numeric' ],
        ];
    }
}
