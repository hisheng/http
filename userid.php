<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/9/18
 * Time: 13:45
 */
require __DIR__.'./vendor/autoload.php';

$hp = new HHttp\CurlHttp();
$parms = array('name'=>'哈222','openid'=>'AAFLuu_3AFZsBtjigsUIXzE-');
$a =  $hp::post('http://beta-meitao.meilimei.com/api/user',$parms);
var_dump($a);