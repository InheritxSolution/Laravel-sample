<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\OauthAccessToken;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'profile_img', 'contact_number', 'status', 'logged_in'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot',
    ];
	
	protected $dates = [
		'created_at', 'updated_at', 'loggedin_at'
	];
	protected $attributes = [
		'user_role' => 0,
		'status' => 1,
	];

	public function getUserRole()
	{
		switch ($this->user_role)
		{
            case 0:
                return 'user';
                break;
            case 1:
                return 'admin';
                break;
            default:
                return 'user';
                break;
        }
    }
	
	public function oAuthAcessToken()
	{
		return $this->hasMany(OauthAccessToken::class, 'user_id', 'id');
	}
	
	public function getOAuthAcessToken(\Illuminate\Http\Request $request)
	{
		if(!empty($request->header('Authorization')))
		{
			$token = explode(' ', $request->header('Authorization'));
			return $token = $token[1];
		}
		
		return NULL;
	}
	
	public function getStatusAttribute($value)
	{
		$status_type = array_flip(config('params.status'));
		if($value == config('params.status.active'))
		{
			return ucfirst($status_type[1]);
		}
		else
		{
			return ucfirst($status_type[0]);
		}
	}
	
	public function setStatusAttribute($value)
	{
		$status_type = array_flip(config('params.status'));
		if($value == $status_type[1])
		{
			$this->attributes['status'] = 1;
		}
		else
		{
			$this->attributes['status'] = 0;
		}
	}

	/**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
