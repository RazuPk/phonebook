<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PhoneBookModel;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PhoneBookController extends Controller
{
    function onInsert(Request $request){
        $key=env('TOKEN_KEY');
        $token=$request->input('access_token');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;
        $user=$decoded_array['user'];
        $one=$request->input('one');
        $two=$request->input('two');
        $name=$request->input('name');
        $email=$request->input('email');
        $result=PhoneBookModel::insert([
            'username'=>$user,
            'phone_number_one'=>$one,
            'phone_number_two'=>$two,
            'name'=>$name,
            'email'=>$email
        ]);
        if($result==true){
            return 'Data saved success';
        }else{
            return 'Failed!try agian..';
        }
    }

    function onSelect(Request $request){
        $key=env('TOKEN_KEY');
        $token=$request->input('access_token');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;
        $user=$decoded_array['user'];
        $result=PhoneBookModel::where('username',$user)->get();
        return $result;
    }
    function onUpdate(Request $request){
        $key=env('TOKEN_KEY');
        $token=$request->input('access_token');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;
        $user=$decoded_array['user'];
        $id=$request->input('id');
        $one=$request->input('one');
        $two=$request->input('two');
        $name=$request->input('name');
        $email=$request->input('email');
        $result=PhoneBookModel::where(['username'=>$user,'id'=>$id])->update([
            'phone_number_one'=>$one,
            'phone_number_two'=>$two,
            'name'=>$name,
            'email'=>$email
        ]);
        if($result==true){
            return 'Data update success';
        }else{
            return 'Update failed';
        }
    }
    function onDelete(Request $request){
        $key=env('TOKEN_KEY');
        $token=$request->input('access_token');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        $decoded_array=(array)$decoded;
        $user=$decoded_array['user'];
        $email=$request->input('email');
        $result=PhoneBookModel::where(['username'=>$user,'email'=>$email])->delete();
        if($result==true){
            return 'Delete success';
        }else{
            return 'Delete Failed';
        }
    }
}
