<?php

/*
|--------------------------------------------------------------------------
| get_url function
|--------------------------------------------------------------------------
|
| this function for generate automatic url for category
| input value $ename
|
*/
function get_url($string)
{
    // delete and replace - to ''
    $url=str_replace('-','',$string);
    //delete and replace / to ''
    $url=str_replace('/','',$url);
    $url=preg_replace('/\s+/','-',$url);
    return $url;
}
/*
|--------------------------------------------------------------------------
| upload_file function
|--------------------------------------------------------------------------
|
| this function for upload file in server
|
| input value $request,$name,$directory
| $file_name = generate file name
*/
function upload_file($request,$name,$directory)
{

    // check if it exists
    if ($request->hasFile($name))
    {
        $file_name=time().'.'.$request->file($name)->getClientOriginalExtension();
        // upload file in server
        if ($request->file($name)->move('files/images/'.$directory,$file_name))
        {
            return $file_name;
        }
        else{
            return null;
        }
    }
    else {
        return null;
    }
}

/*
|--------------------------------------------------------------------------
| Replace number Fa function
|--------------------------------------------------------------------------
|
| this function for replace english number to
| persian number
| input: $number
|
*/
function replace_number($number){
    $number=str_replace("0",'۰',$number);
    $number=str_replace("1",'۱',$number);
    $number=str_replace("2",'۲',$number);
    $number=str_replace("3",'۳',$number);
    $number=str_replace("4",'۴',$number);
    $number=str_replace("5",'۵',$number);
    $number=str_replace("6",'۶',$number);
    $number=str_replace("7",'۷',$number);
    $number=str_replace("8",'۸',$number);
    $number=str_replace("9",'۹',$number);
    return $number;
}
/*
|--------------------------------------------------------------------------
| inTrashed function
|--------------------------------------------------------------------------
|
| this function check Whether or not there is trashed file
| input: $req
|
*/
function inTrashed($req){
    // check Whether or not there is
    if (array_key_exists('trashed',$req) && $req['trashed']=='true'){
        return true;
    }
    else{
        return false;
    }
}

/*
|--------------------------------------------------------------------------
| create_paginate_url function
|--------------------------------------------------------------------------
|
| this function generate paginate Url
| input: $string,$text
|
*/
function create_paginate_url($string,$text)
{
    if ($string=='?')
    {
        $string=$string.$text;
    }else
    {
        $string=$string.'&'.$text;
    }
    return $string;
}
