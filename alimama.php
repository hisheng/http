<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2018/2/23
 * Time: 16:23
 */

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
//php的curl传送cookie
    curl_setopt($ch, CURLOPT_COOKIESESSION, true); //每一次都信的cookie


// 抓取URL并把它传递给浏览器
    $result = curl_exec($ch);

// 关闭cURL资源，并且释放系统资源
    curl_close($ch);
    
    return $result;
}
 
$url = "http://gw.api.taobao.com/router/rest?sign=F21D4084B35FD8D19F076BA6FE5A3FA7&timestamp=2018-02-23+16%3A21%3A55&v=2.0&app_key=24788774&method=taobao.tbk.uatm.favorites.item.get&partner_id=top-apitools&format=json&adzone_id=260136907&favorites_id=11313561&force_sensitive_param_fuzzy=true&fields=num_iid%2Ctitle%2Cpict_url%2Csmall_images%2Creserve_price%2Czk_final_price%2Cuser_type%2Cprovcity%2Citem_url%2Cseller_id%2Cvolume%2Cnick%2Cshop_title%2Czk_final_price_wap%2Cevent_start_time%2Cevent_end_time%2Ctk_rate%2Cstatus%2Ctype%2Cclick_url";

var_dump(httpGet($url));