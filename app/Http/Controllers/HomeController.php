<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$total_users = User::where('user_role', config('params.user_role.user'))->count();
		$total_admins = User::where('user_role', config('params.user_role.admin'))->count();
		
		return view('admin.home', [
			'total_users' => $total_users,
			'total_admins' => $total_admins,
		]);
    }
	
	public function page(Request $request)
	{
		return view('home_page');
	}
}
