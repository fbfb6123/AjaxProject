<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator as LocalValidator;
use Illuminate\Validation\ValidationException;

class PersonValidate extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'nullable|max:30',
            'email' => 'nullable|max:100',
            'tel' => 'nullable|Integer',
        ];
    }
}