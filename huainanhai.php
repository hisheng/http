<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 2018/3/5
 * Time: 11:03
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
 
// 抓取URL并把它传递给浏览器
    $result = curl_exec($ch);

// 关闭cURL资源，并且释放系统资源
    curl_close($ch);
    
    return $result;
}

function huainanhai(){
    $start = '';
    do{
        $url = "http://narya.huainanhai.com/elite/list?limit=10&timeline_type=elite_outbox&is_summary=1&start={$start}";
        $rs = json_decode(httpGet($url));
        $destinationPath = 'h/';
        if(!is_dir($destinationPath)){
            mkdir($destinationPath,0777 );
        }
        if($rs){
            $data = $rs->data;
            $list = $data->list;
            $start = $data->next_start_key;
            echo "{$start} \n";
            if($list){
                foreach ($list as $item){
                    $imgurl = $item->feed_image;
                    if($imgurl){
                        $i = httpGet($imgurl);
                        $filetype = 'jpg';
                        $filename = date("Ymdhis").".".$filetype; //构建新名称
                        $fp = @fopen ($destinationPath.$filename, "w" );
                        @fwrite ($fp,$i);
                        @fclose ($fp);
                    }
                }
            }
        }
    }while($list);
    echo 'done';
}

//huainanhai();


function readH(){
    $dir = 'h/';
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            $files = [];
            while (($file = readdir($dh)) !== false) {
                if($file == '.' || $file == '..'){
                    continue;
                }
                $files[] = $file;
                echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
            }
            closedir($dh);
        }
    }
    $i = 0;
    var_dump($files);
    $num = count($files);
    do{
        echo $files[$i];
        echo "\n";
        $i++;
    }while($i < $num);
}
readH();