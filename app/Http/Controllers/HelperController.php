<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;

class HelperController extends Controller
{
    function sendPushNotification($device_token, $device_type,$msg_notification_data) 
    {
    
        $fields = ['registration_ids'  => [$device_token]];
        $fields['notification'] = $msg_notification_data;
        $fields['data'] = $msg_notification_data;

        $apiKey = "AAAA8lwstBA:APA91bEMaEu75wT_9CnQM7-LQ9aoD86q3g9gS563jzboK0bdcutFV7ujf1jXHxKVim-7mutaIljD3zukx_I2ax-ReHnHFLvChZXVJ_t3igq0hm7RY2dnBthacYI87iGaaIJs2fxd8H8N";

        $headers = ['Authorization: key=' .$apiKey, 'Content-Type: application/json'];

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        
        curl_close($ch);

    
    }

}
