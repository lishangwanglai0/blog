<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as FormRequestlos;

class FormRequest extends FormRequestlos
{
    //当前请求的方法名
    protected $methods;

    public function __construct()
    {
        $this->methods = explode('@', request()->route()->getAction()['controller'])[1];

    }

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
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $array = $validator->errors()->toArray();

        $return_msg = '';
        foreach ($array as $k => $value) {
            $return_msg .= $value[0] . ' / ';
        }
        return dd(result('FAIL', $return_msg));

    }
}
