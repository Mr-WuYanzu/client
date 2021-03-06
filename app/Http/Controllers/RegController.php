<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegController extends Controller
{
    //注册页面
    public function reg(){
        return view('reg');
    }
    //注册执行
    public function regdo(Request $request){
        header('Access-Control-Allow-Origin:*');
        $user_name=$request->user_name??'';
        $email=$request->email??'';
        $password=$request->password??'';
        if(empty($user_name)||empty($email)||empty($password)){
            $response=[
                'errno'=>'42001',
                'msg'=>'缺少参数'
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
        $data=[
            'user_name'=>$user_name,
            'email'=>$email,
            'password'=>$password
        ];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $str=$this->encrypt($data);
        $url='http://api.zhbcto.com/reg';
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $response=curl_exec($ch);

        curl_close($ch);

         echo $response;


    }
    //登录页面
    public function login(){
        return view('login');
    }
    //登录执行
    public function logindo(Request $request){
        $data=$request->all();
        unset($data['_token']);
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $str=$this->encrypt($data);
        $url='http://api.1809a.com/login';
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        $response=curl_exec($ch);
        var_dump($response);
        curl_close($ch);
    }
    public function encrypt($data){
//        dd($data);
        $p=openssl_get_privatekey('file://'.storage_path('app/keys/private.pem'));
        openssl_private_encrypt($data,$encode_str,$p);
        return base64_encode($encode_str);
    }
}
