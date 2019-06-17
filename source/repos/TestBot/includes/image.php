<?php

//單純的訊息回復
$OriginalImageUrl = "";
$PreviewImageUrl = "";

//飲料店相關
 if (strpos(strtolower($message['text']),'teatop') !== false) {
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/T1Ff4O.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/T1Ff4O.jpg";
 }
 if (strpos($message['text'],'一芳') !== false) {
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/2EVHgN.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/2EVHgN.jpg";
 }
  if (strpos($message['text'],'清心') !== false) {
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/6cbsN3.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/6cbsN3.jpg";
 }
  if (strpos($message['text'],'喫茶') !== false) {
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/mKvGqZ.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/mKvGqZ.jpg";
 }
  if (strpos(strtolower($message['text']),'comebuy') !== false) {
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/XpImP2.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/XpImP2.jpg";
 }
  if (strpos($message['text'],'!85度') !== false) {
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/ZBYEit.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/ZBYEit.jpg";
 }

switch($message['text']){
	case "!50嵐":		
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/8UYP1z.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/8UYP1z.jpg";
	break;
	case "!茶湯會":		
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/XnmOh9.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/XnmOh9.jpg";
	break;
	case "!一沐日":		
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/EORqZT.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/EORqZT.jpg";
	break;
	case "!大苑子":		
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/k4qzUX.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/k4qzUX.jpg";
	break;
	case "!迷客夏":		
		$OriginalImageUrl = "https://upload.cc/i1/2019/06/14/fRyg9p.jpg";
		$PreviewImageUrl = "https://upload.cc/i1/2019/06/14/fRyg9p.jpg";
	break;

}
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'image', // 訊息類型 (圖片)
                'originalContentUrl' => $OriginalImageUrl, // 回復圖片
                'previewImageUrl' => $PreviewImageUrl // 回復的預覽圖片
            )
        )
    ));

?>