<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Version;
use App\User;
use App\UserDevice;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\HelperController;

class VersionController extends Controller
{
    public function __construct()
    {
        $this->helperObj = new HelperController();
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {   
        $androidversion = Version::where('device_type', 'android')->where('version_name', function($query){
            $query->select(DB::raw('max(`version_name`) as version_name'))
            ->from('versions')->where('device_type', 'android');
            })->first();

        $iosversion = Version::where('device_type', 'ios')->where('version_name', function($query){
            $query->select(DB::raw('max(`version_name`) as version_name'))
                ->from('versions')->where('device_type', 'ios');
            })->first();

        $id_array = [];

        if($androidversion){
            array_push($id_array,$androidversion->id);
        }
        
        if($iosversion){
            array_push($id_array,$iosversion->id);
        }


        $version = Version::whereIn('id',$id_array);

        //search
        if($request->has('q'))
        {
            $version->where(function($query) use ($request){
                $query->orWhere('version_name', 'like', '%' . $request->get('q') . '%')
                    ->orWhere('device_type', 'like', '%' . $request->get('q') . '%');
            });
        }
        
        //sorting
        $order = $request->get('order'); // Order by what column?
        $dir = $request->get('dir'); // Order direction: asc or desc
        if($order && $dir)
        {
            $version->orderBy($order, $dir);
        }
        else
        {
            $version->latest();
        }
        //$version->get();
        $version = $version->paginate(($request->has('row') && in_array($request->get('row'), config('params.pagination.rows'))) ? $request->get('row') : 10);

        if($request->ajax())
        {
            
            return view('admin.versions.indextable', ['version' => $version->appends($request->except('page')), 'tbl_search' => ($request->has('q')) ? $request->get('q') : ''])->render();
        }
        else
        {
            return view('admin.versions.index', ['version' => $version->appends($request->except('page')), 'tbl_search' => ($request->has('q')) ? $request->get('q') : '']);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.versions.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $this->validate($request, [
            'version_name' => 'required',
            'device_type' => 'required',
        ],[
            'version_name.required' => 'The version number field is required.',
            //'version_name.regex' => 'The version number format is invalid.',
        ]);

        if(!$request->has('force_update'))
        {
            $status_type = config('params.force_update');
            $request->merge(['force_update' => $status_type['no']]);
            $request->force_update = "0";
        }

        $version_name = $request->version_name;

        $vArray = explode('.',$request->version_name);

        if(count($vArray) == 2)
        {
            $version_name = $vArray[0].'.'.$vArray[1].'.0';
        } else 
        if(count($vArray) == 1)
        {
            $version_name = $vArray[0].'.0.0';
        }

        $version = Version::where('device_type', $request->device_type)->orderBy('created_at', 'DESC')->first();

        if($version){

            $currentVersionArray = explode(".",$version_name);
            $dbVersionArray = explode(".", $version->version_name);

            $isUpdateAvailable = 0;
            $forward = 0;

            for ($i = 0; $i < count($currentVersionArray); $i++) 
            {
                $cv = (int)$currentVersionArray[$i];
                $fv = (int)$dbVersionArray[$i];

                if (!$forward) 
                {
                    if ($cv < $fv) 
                    {
                        $isUpdateAvailable = 1;
                        break;
                    }
                }

                if ($cv > $fv) 
                {
                    $forward = 1;
                }
            }

            if($isUpdateAvailable)
            {
                return redirect()->back()->withErrors(['version_name' => trans('message.version_must_greater')])->withInput();
            }
        }

        $version = new Version();
        $version->version_name = $version_name;
        $version->device_type = $request->device_type;
        $version->force_update = $request->force_update;
        if($version->save())
        {
            if($version->device_type == 'android')
            {
                $device_type = 1;
            }
            else
            {
                $device_type = 0;
            }

            $users = UserDevice::where('device_type', $device_type)->get();
           
            if(!empty($users)){
               
                foreach ($users as $user) {

                    if(!empty($user->device_token)) 
                    {

                        $msg_notification_data = [
                            'body'          => "A new version of Admin panel App is available. Please update Admin panel App to use more features.",
                            'title'         => "Admin panel App",
                            'vibrate'       => 1,
                            'sound'         => 1,
                            'type' => "force_update",
                            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
                            //'is_force_update' => ($request->force_update) ? "true" : "false",
                        ];

                        $this->helperObj->sendPushNotification($user->device_token,$user->device_type,$msg_notification_data);
                    }
                }
            }
            
            Session::flash('status', trans('message.version_add_success'));
            Session::flash('status_type', 1);
        }
        else
        {
            Session::flash('status', trans('message.something_wrong'));
            Session::flash('status_type', 0);
        }

    return redirect()->route('version.index');
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
        abort(404);

        $version = Version::findOrFail($id);
        
        return view('admin.version.edit', ['version' => $version]);
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
        abort(404);

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