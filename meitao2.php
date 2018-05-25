<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2018/3/12
 * Time: 18:45
 */
require __DIR__.'./vendor/autoload.php';

$url = "https://meitao.meilimei.com/api/products";

function httpGet($url)
{
    $ch = curl_init();

// 设置URL和相应的选项
    curl_setopt($ch, CURLOPT_URL,$url);
    
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

var_dump(httpGet($url));