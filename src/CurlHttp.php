<?php
/**
 * Created by PhpStorm.
 * User: zhanghaisheng
 * Date: 2016/8/16
 * Time: 16:22
 */

namespace HHttp;

class CurlHttp{
    public static $cookie_file ;
    //get 方法
    
    public function __construct()
    {
        self::$cookie_file = dirname(__DIR__).'./cookie.txt';
    }
    
    public static function get($url,$parms){
        //参数
        
        // 创建一个cURL资源
        $ch = curl_init();
        
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL,$url.'?'.http_build_query($parms));
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //有返回结果数据的  CURLOPT_RETURNTRANSFER = 1
        
        //当请求https的数据时，会要求证书，这时候，加上下面这两个参数，规避ssl的证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //php的curl传送cookie
        curl_setopt($ch, CURLOPT_COOKIESESSION, true); //每一次都信的cookie
        curl_setopt($ch, CURLOPT_COOKIEJAR, self::$cookie_file); //保存
        curl_setopt($ch, CURLOPT_COOKIEFILE, self::$cookie_file); //读取
        
        // 抓取URL并把它传递给浏览器
        $result = curl_exec($ch);
        
        // 关闭cURL资源，并且释放系统资源
        curl_close($ch);
        
        return $result;
    }
    
    //post 方法
    public static function post($url,$params){
        
        //参数相关
        //$url = "https://mm.taobao.com/tstar/search/tstar_model.do?_input_charset=utf-8";
        $postparams =  http_build_query($params);
        
        
        // 创建一个cURL资源
        $ch = curl_init();
        
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出
        
        //当请求https的数据时，会要求证书，这时候，加上下面这两个参数，规避ssl的证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        
        
        //post方式
        curl_setopt($ch, CURLOPT_POST, 1);    // post 提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postparams);
    
        //php的curl传送cookie
        curl_setopt($ch, CURLOPT_COOKIEJAR, self::$cookie_file); //保存
        curl_setopt($ch, CURLOPT_COOKIEFILE, self::$cookie_file); //读取
        
        // 抓取URL并把它传递给浏览器
        $result = curl_exec($ch);
        
        // 关闭cURL资源，并且释放系统资源
        curl_close($ch);
        
        return $result;
    }
    
    
    public static function put($api,$params)
    {
        $postparams =  http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postparams);
        $result = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($result,true);
    }
    
    public static function delete($api,$params)
    {
        $postparams =  http_build_query(self::get_parms($params));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::get_api($api));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: DELETE'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postparams);
        
        
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,true);
    }
    
    public static function test(){
        echo 'http test';
        $parms = array('mobile'=>15190290573,'password'=>'111111');
        $a =  self::get('https://real-user.meilimei.com/api/user/login',$parms);
        print_r($a);
    }
}