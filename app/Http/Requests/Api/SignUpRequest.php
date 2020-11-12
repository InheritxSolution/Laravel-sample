<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ApiHandler;

class SignUpRequest extends FormRequest
{
	public function __construct(Factory $validationFactory)
	{
		$validationFactory->extend('not_email', function($attribute, $value, $parameters) {
			if(filter_var($value, FILTER_VALIDATE_EMAIL))
			{
				return FALSE;
			}
			
			return TRUE;
		});
	}
	
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
            'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email',
			'username' => 'required|max:255|unique:users,username|not_email',
			'password' => 'required|min:6',
			'profile_img' => 'image|mimes:jpeg,jpg,png|max:2048', //max: 2 mb
        ];
    }
	
	/**
	 * Custom error handler for form request
	 * 
	 * @param Validator $validator
	 */
	public function failedValidation(Validator $validator)
    {
		new ApiHandler($validator);
    }
}
