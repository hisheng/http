<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2017/9/18
 * Time: 13:45
 */
require __DIR__.'./vendor/autoload.php';

$hp = new HHttp\CurlHttp();
$a =  $hp::post('https://meitao.meilimei.com/api/user/edit/1100003',[
    'name'=>'hisheg'
]);
var_dump($a);