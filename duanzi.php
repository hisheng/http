<?php
/**
* curl模拟浏览器请求
* @param unknown $url        请求的地址
* @param array $params        请求地址所需要的参数
* @param string $method     请求的类型
* @param array $headers    http请求头
* @return string|mixed
*/
function curlRequest($url, array $params, $method='GET', array $headers=array())
{
// 1.初始化一个curl会话资源
$ch = curl_init();

// 2.设置curl会话的选项
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);    // 强制使用 HTTP/1.0
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);    // 发起连接前等待超时的时间，如果设置为0，则无限等待
curl_setopt($ch, CURLOPT_TIMEOUT, 30);    // 设置curl允许执行的最长秒数
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // 是否将curl_exec()获取的信息返回，而不是直接输出
curl_setopt($ch, CURLOPT_ENCODING, 'gzip');    // 设置HTTP请求头中"Accept-Encoding: "的值
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);    // 启用时会将服务器返回的"Location: "放在header中递归的返回给服务器
curl_setopt($ch, CURLOPT_MAXREDIRS, 5);    // 设置HTTP重定向的最大数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    // 是否需要进行服务端的SSL证书验证
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    // 是否验证服务器SSL证书中的公用名
curl_setopt($ch, CURLOPT_HEADER, false);    // 是否抓取头文件的信息
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);        // 设置HTTP请求头
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
$cookie_file = 'cookie.txt';
curl_setopt($ch, CURLOPT_COOKIESESSION, true); //每一次都信的cookie
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file); //保存
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //读取

switch (strtoupper($method)) {
case 'POST':
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
break;

case 'GET':
$url = "{$url}?" . http_build_query($params);
break;

case 'DELETE':
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
$url = "{$url}?" . http_build_query($params);
break;

default:
return 'invalid request method';
}

curl_setopt($ch, CURLOPT_URL, $url);    // 设置需要请求的URL地址，也可以在 curl_init()函数中设置

// 3.执行curl会话
$response = curl_exec($ch);

// 4.关闭curl会话，释放资源
curl_close($ch);

return $response;
}


$url = 'http://m.neihanshequ.com';
$params = array('is_json'=>1,'app_name'=>'neihanshequ_web','max_time'=>time());
$res = curlRequest($url,$params,'GET',[
    'Accept'=>'application/json, text/javascript'
]);
echo $res;