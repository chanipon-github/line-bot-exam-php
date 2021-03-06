
<?php
$access_token = '6TvBLa/XIptJXxGnGyjbueq2qsxnT+asIMk+Qx25KhJJ23H6ARgKZE5AxxT+HGW3RC+gYDdW7sCA+JOXSbXVxoZuBjSYQzKM3HQkFD+ADpbyT9KL0Rofdpwbkj3M1cd8lOmY/D7CpSC36kKspN0ilQdB04t89/1O/w1cDnyilFU=';
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$access_token}";

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];

// Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "คลาสคาเฟ่ สวัสดีค่ะ";
         $image_url = "https://brandinside.asia/wp-content/uploads/2017/08/class-drive.jpg";
         $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
         $arrayPostData['messages'][1]['type'] = "image";
         $arrayPostData['messages'][1]['originalContentUrl'] = $image_url;
         $arrayPostData['messages'][1]['previewImageUrl'] = $image_url;
          replyMsg($arrayHeader,$arrayPostData);
    }

    //Message Type "Video"
    else if($message == "Hi"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "https://www.youtube.com/watch?v=OxWw8aBcgtQ";
        $arrayPostData['messages'][0]['previewImageUrl'] =  "https://www.mangozero.com/wp-content/uploads/2018/10/16-Oct-02.jpg";
        replyMsg($arrayHeader,$arrayPostData);
    }

    //Message Type "Sticker"
    else if($message == "ขอบคุณค่ะ"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "11539";
        $arrayPostData['messages'][0]['stickerId'] = "52114110";
        replyMsg($arrayHeader,$arrayPostData);
    }

    //Message Type "Location"
    else if($message == "พิกัดคลาสวัดบูรพ์"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "คลาสวัดบูรพ์";
        $arrayPostData['messages'][0]['address'] =   "14.974498,102.110534";
        $arrayPostData['messages'][0]['latitude'] = "14.974498";
        $arrayPostData['messages'][0]['longitude'] = "102.110534";
        replyMsg($arrayHeader,$arrayPostData);
    }

    // Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
		replyMsg($arrayHeader,$arrayPostData);
		
    }

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }

   exit;
?>