<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Hash;

class ChangePasswordFormRequest extends FormRequest
{
	public function __construct(Factory $validationFactory)
    {
        $validationFactory->extend('check_current_password', function ($attribute, $value, $parameters) {
			return Hash::check($value, Auth::User()->password);
		});
    }
	
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		if(Auth::user()->user_role == config('params.user_role.admin'))
		{
			return TRUE;
		}
		
        return FALSE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required|check_current_password',
			'new_password' => 'required|min:6',
			'confirm_password' => 'required|same:new_password',
        ];
    }
}
