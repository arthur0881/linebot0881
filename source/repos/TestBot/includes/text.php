<?php

//ini_set('allow_url_fopen','On');
//ini_set('allow_url_include','On');

//單純的訊息回復
$ReplyText = "";

switch($message['text']){
	case "!打球":		
		$ReplyText = "明早8點打球，誰遲到誰當球";
	break;
	case "!自我介紹":		
		$ReplyText = "我是鋼鐵人(Line機器人ver 1.00)";
	break;
	case "!張博涵":		
		$ReplyText = "雞巴人";
	break;
	case "!翟子毅":		
		$ReplyText = "有夠帥";
	break;
	case "!張家銘":		
		$ReplyText = "姓張的都一樣，雞巴人";
	break;
	case "!李岳庭":		
		$ReplyText = "超越張博涵的雞巴人";
	break;
	case "!高雄":		
		$ReplyText = "挖石油,蓋摩天輪,發大財!!!!!!!";
	break;
	case "!星巴克":	
		$ReplyText = "https://www.starbucks.com.tw/products/drinks.jspx";
	break;
	case "!麥當勞":		
		$ReplyText = "https://www.mcdonalds.com.tw/tw/ch/food.html";
	break;
	case "!漢堡王":		
		$ReplyText = "https://www.burgerking.com.tw/menu.php";
	break;
}

  if (strpos($message['text'],'!肯德基') !== false) {
		$ReplyText = "https://www2.kfcclub.com.tw/tw/Menu/indivdual-meal";
 }
  if (strpos($message['text'],'!摩斯') !== false) {
		$ReplyText = "https://www.mos.com.tw/menu/set.aspx";
 }


//文字回覆

    $client->replyMessage(array(
    'replyToken' => $event['replyToken'],
    'messages' => array(
      array(
          'type' => 'text', // 訊息類型 (文字)
          'text' => $ReplyText // 回復訊息
       )
			
     )
    ));




?>