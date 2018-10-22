<?php

namespace Alri\Test\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestRequest extends FormRequest
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
            'txtName'=>'sometimes|required|min:5',
            'txtFamilly'=>'sometimes|required|min:5',
        ];
    }

    public function messages()
    {
        return [
           'txtName.required'=>'پر کردن فیلد نام',
            'txtName.min'=>'کم بودن فیلد نام',
            'txtFamilly.required'=>'پر کردن نام خانوادگسسی',
            'txtFamilly.min'=>'کمبودن نام خانوادگی',
        ];
    }
}

/*

// use in controller action :

    public function inserForm(TestRequest $request)
    {
        // field is validated . . .
    }

*/
