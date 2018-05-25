<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2018/3/22
 * Time: 13:53
 */

 
//自定义 $userAgent
function get2($url){
    //参数
    $userAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
    
    // 创建一个cURL资源
    $ch = curl_init();
    
    // 设置URL和相应的选项
    curl_setopt($ch, CURLOPT_URL,$url );
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent); //自定义 $userAgent
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //有返回结果数据的  CURLOPT_RETURNTRANSFER = 1
    
    //当请求https的数据时，会要求证书，这时候，加上下面这两个参数，规避ssl的证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    // 抓取URL并把它传递给浏览器
    $result = curl_exec($ch);
    
    // 关闭cURL资源，并且释放系统资源
    curl_close($ch);
    
    return $result;
}

$s = get2("http://sports.qq.com/l/isocce/xijia/laliganews.htm");
var_dump($s);
