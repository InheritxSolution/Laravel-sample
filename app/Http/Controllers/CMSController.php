<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CMS;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cms = CMS::select('id', DB::raw('IFNULL(type, "-") as type, IFNULL(lang, "-") as lang'));
		
		//search
		if($request->has('q'))
		{
			$cms->where(function($query) use ($request){
				$query->orWhere('type', 'like', '%' . $request->get('q') . '%')
					->orWhere('lang', 'like', '%' . $request->get('q') . '%');
			});
		}
		
		//sorting
		$order = $request->get('order'); // Order by what column?
        $dir = $request->get('dir'); // Order direction: asc or desc
		if($order && $dir)
		{
			$cms->orderBy($order, $dir);
		}
		else
		{
			$cms->latest();
		}
		
		$cms = $cms->paginate(($request->has('row') && in_array($request->get('row'), config('params.pagination.rows'))) ? $request->get('row') : 10);
        
		if($request->ajax())
		{
			return view('admin.cms.indextable', ['cms' => $cms->appends($request->except('page')), 'tbl_search' => ($request->has('q')) ? $request->get('q') : ''])->render();
		}
		else
		{
			return view('admin.cms.index', ['cms' => $cms->appends($request->except('page')), 'tbl_search' => ($request->has('q')) ? $request->get('q') : '']);
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
        $cms = CMS::findOrFail($id);
		
		return view('admin.cms.edit', ['cms' => $cms]);
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
        $rules = [
			'content' => 'required',
        ];
		
		$validator = Validator::make($request->all(), $rules);
		
		if($validator->fails())
		{
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
		else
		{
			$cms = CMS::findOrFail($id);
			
			$cms->content = $request->input('content');
			
			if($cms->save())
			{
				Session::flash('status', trans('message.cms_update_success'));
				Session::flash('status_type', 1);
			}
			else
			{
				Session::flash('status', trans('message.something_wrong'));
				Session::flash('status_type', 0);
			}
			
			return redirect()->back()->withInput();
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
