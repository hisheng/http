<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/11/9
 * Time: 12:12
 */

require __DIR__.'./vendor/autoload.php';

$hp = new HHttp\CurlHttp();
var_dump($hp::$cookie_file);
$parms = array('nickname'=>'哈222','openid'=>'AAFLuu_3AFZsBtjigsUIXzE-2');
$a =  $hp::post('http://wawa.com/api/user',$parms);
var_dump($a);