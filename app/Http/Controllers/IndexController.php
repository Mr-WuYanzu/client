<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){
        $iv='d89fb057f6d4f03g';
        $key='zhb';
        $arr=[
            'nickname'=>'李童宵',
            'sex'=>'1',
            'city'=>'北京'
        ];
        $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
        $data=$this->testsign($str);
        $url='http://api.1809a.com/index?sign='.urlencode($data);
        $ch=curl_init();
        //初始化路径
        curl_setopt($ch,CURLOPT_URL,$url);
        // 将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //使用post方式请求
        curl_setopt($ch,CURLOPT_POST,1);
        //请求携带的参数
        curl_setopt($ch,CURLOPT_POSTFIELDS,$str);
        //将请求数据格式定义成字符串
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:text/plain']);
        //获取信息
        $data=curl_exec($ch);
        curl_close($ch);
    }
    //凯撒加密
//    public function encrypt($user_name,$n){
//        $pass='';
//        for($i=0;$i<strlen($user_name);$i++){
//            $p=ord($user_name[$i])+$n;
//            $pass .= chr($p);
//        }
//        return $pass;
//    }
    //对称加密
    public function encode($strContent,$key,$iv) {
        $encode=openssl_encrypt($strContent,'AES-256-CBC',$key,OPENSSL_RAW_DATA,$iv);
        return base64_encode($encode);
    }
    //非对称加密
    public function encrypt($data){
//        dd($data);
        $p=openssl_get_privatekey('file://'.storage_path('app/keys/private.pem'));
        openssl_private_encrypt($data,$encode_str,$p);
        return base64_encode($encode_str);
    }
    //计算签名
    public function testsign($data){
        $key=openssl_get_privatekey('file://'.storage_path('app/keys/private.pem'));
        openssl_sign($data,$sign,$key);
        return base64_encode($sign);
    }
}
