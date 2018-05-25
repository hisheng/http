<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/11/9
 * Time: 12:12
 */

require __DIR__.'./vendor/autoload.php';




$hp = new HHttp\CurlHttp();


//$parms = array('openid'=>'oDjwm07hlO6MnYnO9pN6Knd8QJk4');
//$a =  $hp::post('http://114.55.75.232:9501/api/user',$parms);
//var_dump($a);
//
//var_dump($hp::$cookie_file);
//$as =  $hp::get('http://114.55.75.232:9501/api/user/session',[]);
//var_dump($as);
$as =  $hp::put('http://114.55.75.232:9501/api/address/203',[
    'name'=>'hisheng'
]);
var_dump($as);