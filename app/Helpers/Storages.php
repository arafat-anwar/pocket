<?php

function getPath($path){
    return str_replace(config('app.system_public_path'), '', public_path($path));
}

function fileInfo($file){
    if(isset($file)){
        return $image = array(
            'name' => $file->getClientOriginalName(), 
            'type' => $file->getClientMimeType(), 
            'size' => $file->getSize(), 
            'width' => isset(getimagesize($file)[0]) ? getimagesize($file)[0] : 0, 
            'height' => isset(getimagesize($file)[1]) ? getimagesize($file)[1] : 0, 
            'extension' => $file->getClientOriginalExtension(), 
        );
    }else{
        return $image = array(
            'name' => '0', 
            'type' => '0', 
            'size' => '0', 
            'width' => '0', 
            'height' => '0', 
            'extension' => '0', 
        );
    }
    
}

function fileUpload($file, $destination, $name){
    return $file->move(getPath($destination), $name);
}

function fileMove($oldPath,$newPath){
    return File::move($oldPath, $newPath);
}

function fileDelete($path){
    if(!empty($path) && file_exists(getPath($path))){
        return unlink(getPath($path));
    }
    return false;
}

function formatBytes($size, $precision = 2){
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
} 

function userImage($user){
    $image = (isset($user->image) ? $user->image : '');
    if(!empty($image) && file_exists(getPath($image))){
        return asset($image);
    }else{
        $gender = (isset($user->gender) ? $user->gender : 0);
        if($gender == 0){
            return asset('img/female.png');
        }else{
            return asset('img/male.png');
        }
    }
}

function userImageSolid($employee){
    $image = (isset($user->image) ? $user->image : '');
    if(!empty($image) && file_exists(getPath($image))){
        return asset($image);
    }else{
        $gender = (isset($user->gender) ? $user->gender : 0);
        if($gender == 0){
            return 'img/female.png';
        }else{
            return 'img/male.png';
        }
    }
}