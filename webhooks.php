
<?php
    define('LINE_API',"https://notify-api.line.me/api/notify");
    $token = "6TvBLa/XIptJXxGnGyjbueq2qsxnT+asIMk+Qx25KhJJ23H6ARgKZE5AxxT+HGW3RC+gYDdW7sCA+JOXSbXVxoZuBjSYQzKM3HQkFD+ADpbyT9KL0Rofdpwbkj3M1cd8lOmY/D7CpSC36kKspN0ilQdB04t89/1O/w1cDnyilFU="; 
    $str = "มีรายการสั่งซื้อ กรุณาเช็ค อีเมลล์ครับ"; 
    $res = notify_message($str,$token);
    print_r($res);
    function notify_message($message,$token){
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array( 
    'http'=>array(
    'method'=>'POST',
    'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
    ."Authorization: Bearer ".$token."\r\n"
    ."Content-Length: ".strlen($queryData)."\r\n",
    'content' => $queryData
    ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    return $res;
    }
?>