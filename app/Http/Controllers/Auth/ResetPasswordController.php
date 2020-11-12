<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
	private $user;

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'preventBackHistory']);
    }
	
	public function showResetForm(Request $request, $token = null)
    {
		if(Auth::check())
		{
			return redirect()->route('home');
		}
		
		if(Session::has('success_password_reset'))
		{
			return view('auth.passwords.SuccessPasswordReset');
		}
		else
		{
			return view('auth.passwords.reset')->with(
				['token' => $token, 'email' => $request->email]
			);
		}
    }
	
	public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
       
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
				$this->user = $user;
            }
        );
		
		if($response == Password::PASSWORD_RESET)
		{
			if($this->user->user_role == config('params.user_role.admin'))
			{
				return $this->sendResetResponse($response);
			}
			else
			{
				Session::flash('status', trans($response));
				Session::flash('status_type', 1);
				Session::flash('success_password_reset', 1);
				return redirect()->back();
			}
		}
		else
		{
			return $this->sendResetFailedResponse($request, $response);
		}
    }
	
	protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

		if($user->user_role == config('params.user_role.admin'))
		{
			$this->guard()->login($user);
		}
    }
	
	protected function sendResetResponse($response)
    {
		Session::flash('status', trans($response));
		Session::flash('status_type', 1);
		
        return redirect($this->redirectPath());
    }
	
	protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }
}
