<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CommonRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function formatErrors(Validator $validator)
    {
        $error_keys = $validator->messages()->keys();
        $return['info']   = $validator->errors()->first();
        $return['status'] = -1;
        $return['id']     = head($error_keys);
        return $return;

    }

    public function response(array $errors)
    {

        return response()->json($errors);
    }


}