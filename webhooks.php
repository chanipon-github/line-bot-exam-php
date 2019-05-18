
<?php
$access_token = '6TvBLa/XIptJXxGnGyjbueq2qsxnT+asIMk+Qx25KhJJ23H6ARgKZE5AxxT+HGW3RC+gYDdW7sCA+JOXSbXVxoZuBjSYQzKM3HQkFD+ADpbyT9KL0Rofdpwbkj3M1cd8lOmY/D7CpSC36kKspN0ilQdB04t89/1O/w1cDnyilFU=';
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$access_token}";

    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];

    case "t_b":
    // กำหนด action 4 ปุ่ม 4 ประเภท
    $actionBuilder = array(
        new MessageTemplateActionBuilder(
            'Message Template',// ข้อความแสดงในปุ่ม
            'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
        ),
        new UriTemplateActionBuilder(
            'Uri Template', // ข้อความแสดงในปุ่ม
            'https://www.ninenik.com'
        ),
        new DatetimePickerTemplateActionBuilder(
            'Datetime Picker', // ข้อความแสดงในปุ่ม
            http_build_query(array(
                'action'=>'reservation',
                'person'=>5
            )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
            'datetime', // date | time | datetime รูปแบบข้อมูลที่จะส่ง ในที่นี้ใช้ datatime
            substr_replace(date("Y-m-d H:i"),'T',10,1), // วันที่ เวลา ค่าเริ่มต้นที่ถูกเลือก
            substr_replace(date("Y-m-d H:i",strtotime("+5 day")),'T',10,1), //วันที่ เวลา มากสุดที่เลือกได้
            substr_replace(date("Y-m-d H:i"),'T',10,1) //วันที่ เวลา น้อยสุดที่เลือกได้
        ),      
        new PostbackTemplateActionBuilder(
            'Postback', // ข้อความแสดงในปุ่ม
            http_build_query(array(
                'action'=>'buy',
                'item'=>100
            )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
            'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
        ),      
    );
    $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
    $replyData = new TemplateMessageBuilder('Button Template',
        new ButtonTemplateBuilder(
                'button template builder', // กำหนดหัวเรื่อง
                'Please select', // กำหนดรายละเอียด
                $imageUrl, // กำหนด url รุปภาพ
                $actionBuilder  // กำหนด action object
        )
    );              
    break;  




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


?>