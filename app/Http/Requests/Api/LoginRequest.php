<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ApiHandler;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
		return [
            'login' => 'required',
			'password' => 'required',
        ];
    }
	
	/**
	 * Custom error handler for form request
	 * @param Validator $validator
	 * @throws ApiHandler
	 */
	public function failedValidation(Validator $validator)
    {
		new ApiHandler($validator);
    }
}
