<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ApiHandler;

class CMSRequest extends FormRequest
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
    public function rules()
    {	
		return [
			'cms_page' => [
				'required',
				Rule::in(config('params.cms'))
			]
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
