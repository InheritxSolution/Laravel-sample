<?php

if (!function_exists('activeMenu')) {
    
	function activeMenu($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if(request()->segment($segment) != $p) {
                return '';
            }
            $segment++;
        }
        return 'active';
    }	
}

if (!function_exists('uploadImage')) {
    function uploadImage($request, $path) {

        $file = $request->logo;
        $name = explode('.',$file->getClientOriginalName());
        $time = time();
        $imageName = str_replace(' ', '-', trim($name[0].$time .'.'. $file->getClientOriginalExtension()));

        $file->move(
            base_path() . $path, $imageName
        );
        
        return $imageName;   
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($request, $path) {

        $file = $request->new_file;
        $name = $file->getClientOriginalName();
        $split = pathinfo($name);
        $time = time();
        $fileName = str_replace(' ', '-', trim($split['filename'].$time .'.'. $file->getClientOriginalExtension()));
        
        $file->move(
            base_path() . $path, $fileName
        );
       
        return $fileName;   
    }
}
