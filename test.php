<?php
/**
 * Created by PhpStorm.
 * User: hisheng
 * Date: 2017/9/13
 * Time: 17:03
 */
require __DIR__.'./vendor/autoload.php';

$hp = new HHttp\CurlHttp();
//$hp::test();




$parms = array('reply_id'=>507,'desc'=>'cli test');
$a =  $hp::post('https:/api/beauty_comment/create',$parms);
var_dump($a);
