<?php

ini_set('allow_url_fopen','On');
ini_set('allow_url_include','On');

//TEST
if ($message['text'] == "!TTT"){	
	$result = "TTT";

	
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' => $result // 回復訊息
            )
			
        )
    ));
}

//功能 : 猜拳
if ($message['text'] == "!猜拳"){	
	$result = "";
	switch(rand(1,3))
	{
		case 1:
			$result = "剪刀";
		break;
		case 2:
			$result = "石頭";
		break;
		case 3:
			$result = "布";
		break;
	}
	
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' => $result // 回復訊息
            )
			
        )
    ));
}

//功能 : 丟骰子
if ($message['text'] == "!骰子"){	
	$point = rand(1,6);
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' => (string)$point // 回復訊息
            )
			
        )
    ));
}

 //功能 : 查匯率
if (strpos($message['text'],'!') !== false && strpos($message['text'],'匯率') !== false){	
	require_once($_SERVER['DOCUMENT_ROOT'] .'/simple_html_dom.php');
	$html = file_get_html('https://rate.bot.com.tw/xrt?Lang=zh-TW');	

	 $moneytype = array();
	 $moneyrate = array();
	 $inputmoney = array();
	 $inputmoney2 = array();

	 $inputmoney = explode('!',$message['text']);
	 $inputmoney2 = explode('匯率',$inputmoney[1]);
	 $comparemoney = $inputmoney2[0]; 
	 $caculateMoney = 0;
	 $NeedToCaculate = false;
	 
	 //假入要換匯試算的話才有用
	 if(strpos($message['text'],'換') !== false)
	 {
		$changeMoney = explode('換',$message['text']);
		if(is_int((int)$changeMoney[1]) == true)
		{
			if($changeMoney[1] > 0)
			{
				$NeedToCaculate = true;
			    $caculateMoney = $changeMoney[1];
			}
		}
	 }	 
 foreach($html->find('tbody') as $element){
	 foreach($element->find("div[class='visible-phone print_hide']") as $divmoney)	{	
	array_push($moneytype,strip_tags($divmoney));
	 }
 }

 $i = 0;

 foreach($html->find("td[data-table='本行現金賣出']") as $rate) {
	 if($i%2 == 0)
	 {
		 array_push($moneyrate,strip_tags($rate));
	 }
       $i++;
 }

 for($x = 0;$x < count($moneytype);$x++){
 if(strpos($moneytype[$x],$comparemoney) !== false){
	 $text = "台灣銀行牌告匯率\n幣別:".trim($moneytype[$x])."\n今日匯率:".$moneyrate[$x];
	 if($NeedToCaculate == true)
	 {
		 $SplitMoneyType = explode("(",trim($moneytype[$x]));
		 $CaculateResult = floor($caculateMoney/(float)$moneyrate[$x]);
		 $text = "台灣銀行牌告匯率\n幣別:".trim($moneytype[$x])."\n今日匯率:".$moneyrate[$x]."\n".(string)$caculateMoney."台幣可換".(string)$CaculateResult.$SplitMoneyType[0];
	 }	 
	 //$NoSpaceText = trim($text);
	//$NoSpaceText = preg_replace('/\s(?=)/', '', trim($text));
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' =>  preg_replace('/<br\\s*?\/??>/i','',nl2br(trim($text))) // 回復訊息
            )
			
        )
    ));
   }
  }

 }

//功能 : 早餐吃什麼
if ($message['text'] == "!早餐吃什麼"){	
	$result = "";
	switch(rand(1,10))
	{
		case 1:
			$result = "漢堡";
		break;
		case 2:
			$result = "蛋餅";
		break;
		case 3:
			$result = "鐵板麵";
		break;
		case 4:
			$result = "烤土司";
		break;
		case 5:
			$result = "乳酪餅";
		break;
		case 6:
			$result = "蔥抓餅";
		break;
		case 7:
			$result = "蘿蔔糕";
		break;
		case 8:
			$result = "可颂";
		break;
		case 9:
			$result = "貝果";
		break;
		case 10:
			$result = "三明治";
		break;
	}
	
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' => $result // 回復訊息
            )
			
        )
    ));
}

//功能 : 早餐喝什麼
if ($message['text'] == "!早餐喝什麼"){	
	$result = "";
	switch(rand(1,7))
	{
		case 1:
			$result = "紅茶";
		break;
		case 2:
			$result = "綠茶";
		break;
		case 3:
			$result = "奶茶";
		break;
		case 4:
			$result = "豆漿";
		break;
		case 5:
			$result = "果汁系列";
		break;
		case 6:
			$result = "咖啡";
		break;
		case 7:
			$result = "薏仁漿";
		break;
	}
	
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' => $result // 回復訊息
            )
			
        )
    ));
}

//功能 : 能不能出發去日本占卜
if ($message['text'] == "!肺炎占卜"){	
	$result = "";
	switch(rand(1,3))
	{
		case 1:
			$result = "讚啦 一定可以去";
		break;
		case 2:
			$result = "不好說 繼續觀望";
		break;
		case 3:
			$result = "沒救了呵呵呵";
		break;

	}
	
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text', // 訊息類型 (文字)
                'text' => $result // 回復訊息
            )
			
        )
    ));
}

?>