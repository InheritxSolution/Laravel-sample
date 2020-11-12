<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Validator;
use App\Version;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class VersionController extends Controller
{
   /**
    * Common logout api for userApp and adminApp
    *
    * @return response
    **/

   public function getAppVersion(Request $request)
   {
      if(!$request->has('device_type'))
      {
          return ['status' => '0','status_code' => 200,'message' => 'device_type is required.'];
      }

      if(!$request->has('current_version'))
      {
          return ['status' => '0','status_code' => 200,'message' => 'current_version is required.'];
      }

      $latest_version = Version::where('device_type',$request->device_type)->orderby('id','desc')->get()->first();

      if(!empty($latest_version))
      {
          $currentVersionArray = explode(".",$request->current_version);
          $dbVersionArray = explode(".", $latest_version->version_name);

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

          if ($isUpdateAvailable == 0) 
          {
              $message = 'Application is up to date!';
              $data['device_type']        = $request->device_type;
              $data['version_name']       = $request->current_version;
              $data['force_update']     = '0';
              $data['is_new_version_available'] = '0';

              return response()->json(['status' => "1",'message' => $message,'data' => $data]);

          } 
          else 
          {
            $message = "";
            $data = [];

              if ($latest_version->force_update) 
              {
                  $data['force_update'] = '1';
                  $data['is_new_version_available'] = '1';
                  $message = 'A new version of '.config('app.name').' is available.  Please update '.env('APP_NAME').' to use more features.';
              }
              // Check if there's any intermediate forceful update.
              else 
              {

                  $forceUpdate = Version::where(
                          [
                              'device_type' => $request->device_type,
                              'force_update'   => 1,
                          ]
                      )
                      ->where('version_name', '>' ,$request->current_version)
                      ->get()->first();

                  if ($forceUpdate) 
                  {
                      $data['force_update'] = '1';
                      $data['is_new_version_available'] = '1';
                      $message = 'A new version of '.config('app.name').' is available.  Please update '.env('APP_NAME').' to use more features.';
                  } 
                  else 
                  {
                      $data['force_update'] = '0';
                      $data['is_new_version_available'] = '1';
                      $message = 'New version of '.config('app.name').' is available!';
                  }
              }

              return response()->json(['status' => "a" ,'message' => $message,'data' => $data]);
            
          }
      }
      else
      {
        return response()->json(['status' => '1','message' => 'No data found.','data'=>(object)[]]);
      } 

    
   }
   
}
