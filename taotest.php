<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/9/18
 * Time: 13:45
 */
require __DIR__.'./vendor/autoload.php';

$hp = new HHttp\CurlHttp();
var_dump($hp::$cookie_file);

$parms = array('advice'=>'哈哈建议啊啊','user_id'=>'1');
$a =  $hp::post('http://taosex.com/api/advice',$parms);
var_dump($a);