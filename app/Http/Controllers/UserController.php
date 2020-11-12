<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use App\Http\Requests\ChangePasswordFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Validation\Rule;

class UserController extends Controller {

    public function index(Request $request)
	{
        $users = User::select('profile_img', DB::raw('case when length(name) > 20 then concat(substring(name, 1, 20), "...") else IFNULL(name, "-") end as name'), DB::raw('case when length(email) > 20 then concat(substring(email, 1, 20), "...") else IFNULL(email, "-") end as email'), 'id', 'created_at');
		
		if($request->has('filter'))
		{
			if($request->input('filter') == 'user')
			{
				$users->where('user_role', '=', config('params.user_role.user'));
			}
			else if($request->input('filter') == 'admin')
			{
				$users->where('user_role', '=', config('params.user_role.admin'));
			}
		}
		
		//search
		if($request->has('q'))
		{
			$users->where(function($query) use ($request){
				$query->orWhere('name', 'like', '%' . $request->get('q') . '%')
					->orWhere('email', 'like', '%' . $request->get('q') . '%');
			});
		}
		
		//sorting
		$order = $request->get('order'); // Order by what column?
        $dir = $request->get('dir'); // Order direction: asc or desc
		if($order && $dir)
		{
			$users->orderBy($order, $dir);
		}
		else
		{
			$users->latest();
		}
		
		$users = $users->paginate(($request->has('row') && in_array($request->get('row'), config('params.pagination.rows'))) ? $request->get('row') : 10);
		
		if($request->ajax())
		{
			return view('admin.users.indextable', ['users' => $users->appends($request->except('page')), 'tbl_search' => ($request->has('q')) ? $request->get('q') : ''])->render();
		}
		else
		{
			return view('admin.users.index', ['users' => $users->appends($request->except('page')), 'tbl_search' => ($request->has('q')) ? $request->get('q') : '']);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
	{
		abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
	{
        $user = User::where('id', $id)->first();
		if($user)
		{
			return view('admin.users.show-user', ['user' => $user]);
		}
		
		abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
	{
        $user = User::where('id', $id)->first();
		if($user)
		{
			return view('admin.users.edit-user', ['user' => $user]);
		}
		
		abort(404);
    }
	
    public function editProfile()
	{
        $user = User::where('id', Auth::User()->id)->where('user_role', '=', config('params.user_role.admin'))->first();
		if($user)
		{
			return view('admin.profile.edit_profile', ['user' => $user]);
		}
		
		abort(404);
    }
	
    public function editPassword()
	{
		$user = User::where('id', Auth::User()->id)->where('user_role', '=', config('params.user_role.admin'))->first();
		if($user)
		{
			return view('admin.profile.edit_password');
		}
	
		abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
	{
		$status_type = array_flip(config('params.status'));
		
		if(!$request->has('status'))
		{
			$status_type = array_flip(config('params.status'));
			$request->merge(['status' => $status_type[0]]);
		}
		
        $rules = [
			'name' => 'required|max:255',
			'status' => [
				'required',
				Rule::in(array_keys(config('params.status'))),
			],
        ];
		
        $validator = Validator::make( $request->all(), $rules);
        
        if($validator->fails())
		{
			return redirect()->back()->withErrors($validator->errors())->withInput();
        }
		else
		{
			if($request->input('status') == $status_type[0])
			{
				$total_active_admins = User::where('status', config('params.status.active'))->where('user_role', '=', config('params.user_role.admin'))->where('id', '!=', $id)->count();
				if($total_active_admins <= 0)
				{
					Session::flash('status', trans('message.admin_active_atleast_one'));
					Session::flash('status_type', 0);
					return redirect()->back();
				}
			}
			
			$user_model = User::where('id', $id)->first();
            if($user_model)
			{
				$user_model->name = $request->input('name');
				$user_model->status = $request->input('status');

				if ($user_model->save()) {
					Session::flash('status', trans('message.user_update_success'));
					Session::flash('status_type', 1);
				} else {
					Session::flash('status', trans('message.something_wrong'));
					Session::flash('status_type', 0);
				}
				
				return redirect()->back()->withInput();
			}
        }
		
		abort(404);
    }
	
    public function updateProfile(Request $request)
	{
		$user_model = User::where('id', Auth::User()->id)->where('user_role', '=', config('params.user_role.admin'))->first();
		$rules = [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,' . $user_model->id,
			'contact_number' => 'nullable|max:15|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
        ];
		
		if($request->hasFile('profile_img'))
		{
			$rules['profile_img'] = 'required|image|mimes:jpeg,png,jpg|max:2048'; //max: 2 mb
		}
		
        $validator = Validator::make( $request->all(), $rules);
        
        if($validator->fails())
		{
			return redirect()->back()->withErrors($validator->errors())->withInput();
        }
		else
		{
			if($user_model)
			{
				$user_model->name = $request->input('name');
				$user_model->email = $request->input('email');
				$user_model->contact_number = $request->input('contact_number');

				//upload profile img
				if($request->has('profile_img_thumb') && $request->profile_img_thumb != null)
				{	
					if (file_exists(base_path().'/img/'.$user_model->profile_img)) {
						unlink(base_path().'/img/'.$user_model->profile_img);
					}
					
					$request->logo = $request->profile_img;
					$destination_path = config('params.image_upload_path.sadmin_image');
            		$user_model->profile_img = uploadImage($request,$destination_path);	
				}

				//upload profile img
				/* CODE to upload pic on AWS s3
				if($request->has('profile_img_thumb'))
				{
					try
					{
						//delete previous profile img
						if(Storage::disk('s3')->exists($user_model->profile_img))
						{
							Storage::disk('s3')->delete($user_model->profile_img);
						}
						
						$file_name = uniqid('', TRUE);
						$thumb_filename = $file_name . '.png';
						$tmpthumb = config('params.tmp.upload') . $thumb_filename;
						
						list($type, $data) = explode(';', $request->input('profile_img_thumb'));
						list($type, $data) = explode(',', $data);
						$thumb_img = base64_decode($data);
						
						file_put_contents($tmpthumb, $thumb_img);
						$path = Storage::disk('s3')->putFile(config('params.s3_path.profile_img'), new File($tmpthumb));
						unlink($tmpthumb);
						
						if($path)
						{
							$user_model->profile_img = $path;
						}
						else
						{
							Session::flash('status', trans('message.something_wrong'));
							Session::flash('status_type', 0);
							return redirect()->back()->withInput();
						}
					}
					catch (Exception $e)
					{
						Session::flash('status', trans('message.something_wrong'));
						Session::flash('status_type', 0);
						return redirect()->back()->withInput();
					}
				}*/

				if ($user_model->save()) {
					Session::flash('status', trans('message.profile_update_success'));
					Session::flash('status_type', 1);
					return redirect()->back()->withInput();
				} else {
					Session::flash('status', trans('message.something_wrong'));
					Session::flash('status_type', 0);
					return redirect()->back()->withInput();
				}
			}
        }
		
		abort(404);
    }

	public function updatePassword(ChangePasswordFormRequest $request)
	{
		$user = User::where('id', Auth::User()->id)->where('user_role', '=', config('params.user_role.admin'))->first();
		$user->password = Hash::make($request->input('new_password'));

		if($user->save())
		{
			Session::flash('status', trans('message.password_update_success'));
			Session::flash('status_type', 1);
		}
		else
		{
			Session::flash('status', trans('message.something_wrong'));
			Session::flash('status_type', 0);
		}
		
		return redirect()->back();
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
	{
		$is_admin = User::where('user_role', '=', config('params.user_role.admin'))->where('id', '=',$id)->count();

		if($is_admin)
		{
			//echo trans('message.admin_exists_atleast_one');exit();

			Session::flash('status', trans('message.admin_exists_atleast_one'));
			Session::flash('status_type', 0);
			return redirect()->back();
		}
		
		$user = User::where('id', $id)->first();
		
		if($user)
		{
			/*try
			{
				//delete previous profile img
				if(Storage::disk('s3')->exists($user->profile_img))
				{
					Storage::disk('s3')->delete($user->profile_img);
				}
			}
			catch (Exception $e)
			{
				Session::flash('status', trans('message.something_wrong'));
				Session::flash('status_type', 0);
				return redirect()->back()->withInput();
			}*/
		
			$is_delete = $user->destroy($id);
			if($is_delete)
			{
				Session::flash('status', trans('message.user_delete_success'));
				Session::flash('status_type', 1);
				return redirect()->back();
			}
			else
			{
				Session::flash('status', trans('message.something_wrong'));
				Session::flash('status_type', 0);
				return redirect()->back();
			}
		}
		
		abort(404);
    }
}
