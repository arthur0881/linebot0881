<?php

$Asking = false;

//讀檔案到 $LoadFile 陣列內
$LoadFile = file("LineBotGame_Record\Game_UltimateCode.txt");
	
//遊戲 : 終極密碼
if($message['text'] == '!終極密碼' && trim($LoadFile[0]) != 'StartGame' && $Asking == false)
{
	$Game_UltimateCodeFile = fopen("LineBotGame_Record\Game_UltimateCode.txt", "w") or die("Unable to open file!");
	fwrite($Game_UltimateCodeFile, "StartGame\n"); // Array[0] 遊戲開始了沒
	fwrite($Game_UltimateCodeFile, (string)rand(1,100)."\n");//Array[1] 目標數字
	fwrite($Game_UltimateCodeFile, "1\n"); //Array[2] 最小數字
	fwrite($Game_UltimateCodeFile, "100\n");//Array[3] 最大數字
	fwrite($Game_UltimateCodeFile, "1\n");//Array[4] 猜的次數
	fclose($Game_UltimateCodeFile);
			$client->replyMessage(array(
			'replyToken' => $event['replyToken'],
			'messages' => array(
			array(
			'type' => 'text', // 訊息類型 (文字)
			'text' => "遊戲開始,請輸入1~100間的數字 #數字(EX:#50)來猜" // 回復訊息
					)			
				)
			));
}

if($message['text'] == '!終極密碼結束' && trim($LoadFile[0]) == 'StartGame')
{
	$Asking = true;
	$Game_UltimateCodeFile = fopen("LineBotGame_Record\Game_UltimateCode.txt", "w") or die("Unable to open file!");
	fwrite($Game_UltimateCodeFile, ""); 
	fclose($Game_UltimateCodeFile);
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "已終止遊戲" // 回復訊息
				)			
			)
		));
}
if($message['text'] == '!終極密碼結束' && trim($LoadFile[0]) != 'StartGame')
{
	$Asking = true;
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "無遊戲進行中" // 回復訊息
				)			
			)
		));
}
if($message['text'] == '!終極密碼狀態' && trim($LoadFile[0]) == 'StartGame')
{
	$Asking = true;
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "遊戲進行中，"."數字在".trim((string)$LoadFile[2])."到".trim((string)$LoadFile[3])."之間" // 回復訊息
				)			
			)
		));
}
if($message['text'] == '!終極密碼狀態' && trim($LoadFile[0]) != 'StartGame')
{
	$Asking = true;
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "無遊戲進行中" // 回復訊息
				)			
			)
		));
}

if(trim($LoadFile[0]) == 'StartGame' && $Asking == false && strpos($message['text'],'#') !== false)
{
	$InputNumber = explode('#',$message['text']);
	$Input = $InputNumber[1];
	if(strlen($Input) == strlen((string)((int)$Input))){
		$GuessNumber = trim((int)$Input);
		$TargetCode = trim((string)$LoadFile[1]);
		$MinNumber = trim((string)$LoadFile[2]);
		$MaxNumber = trim((string)$LoadFile[3]);
		$GuessAmount = trim((string)$LoadFile[4]);
		if($GuessNumber >= $MinNumber && $GuessNumber <= $MaxNumber && $GuessNumber != $TargetCode)
		{
			if($GuessNumber < $TargetCode){
					$Game_UltimateCodeFile = fopen("LineBotGame_Record\Game_UltimateCode.txt", "w") or die("Unable to open file!");
					fwrite($Game_UltimateCodeFile, "StartGame\n"); // Array[0] 遊戲開始了沒
					fwrite($Game_UltimateCodeFile, $TargetCode."\n");//Array[1] 目標數字
					fwrite($Game_UltimateCodeFile, (string)$GuessNumber."\n"); //Array[2] 最小數字
					fwrite($Game_UltimateCodeFile, $MaxNumber."\n");//Array[3] 最大數字
					fwrite($Game_UltimateCodeFile, (string)((int)$GuessAmount+1)."\n");//Array[4] 猜的次數
					fclose($Game_UltimateCodeFile);
			}
			else
			{
					$Game_UltimateCodeFile = fopen("LineBotGame_Record\Game_UltimateCode.txt", "w") or die("Unable to open file!");
					fwrite($Game_UltimateCodeFile, "StartGame\n"); // Array[0] 遊戲開始了沒
					fwrite($Game_UltimateCodeFile, $TargetCode."\n");//Array[1] 目標數字
					fwrite($Game_UltimateCodeFile, $MinNumber."\n"); //Array[2] 最小數字
					fwrite($Game_UltimateCodeFile, (string)$GuessNumber."\n");//Array[3] 最大數字
					fwrite($Game_UltimateCodeFile, (string)((int)$GuessAmount+1)."\n");//Array[4] 猜的次數
					fclose($Game_UltimateCodeFile);
			}
				$LoadFile = file("LineBotGame_Record\Game_UltimateCode.txt");
				$MinNumber = trim((string)$LoadFile[2]);
				$MaxNumber = trim((string)$LoadFile[3]);
				$client->replyMessage(array(
				'replyToken' => $event['replyToken'],
				'messages' => array(
				array(
				'type' => 'text', // 訊息類型 (文字)
				'text' => "數字在".$MinNumber."到".$MaxNumber."之間" // 回復訊息
						)			
					)
				));
				


		}
		if($GuessNumber < $MinNumber || $GuessNumber > $MaxNumber)
		{
			$client->replyMessage(array(
			'replyToken' => $event['replyToken'],
			'messages' => array(
			array(
			'type' => 'text', // 訊息類型 (文字)
			'text' => "輸入錯誤!!數字是在".$MinNumber."到".$MaxNumber."之間" // 回復訊息
					)			
				)
			));					
		}
		if($GuessNumber >= $MinNumber && $GuessNumber <= $MaxNumber && $GuessNumber == $TargetCode)
		{
			if($GuessAmount != "1")
			{
				$Game_UltimateCodeFile = fopen("LineBotGame_Record\Game_UltimateCode.txt", "w") or die("Unable to open file!");
				fwrite($Game_UltimateCodeFile, ""); 
				fclose($Game_UltimateCodeFile);	
				$client->replyMessage(array(				
				'replyToken' => $event['replyToken'],
				'messages' => array(
				array(
				'type' => 'text', // 訊息類型 (文字)
				'text' => "爆炸啦,總共猜了".$GuessAmount."次" // 回復訊息
						)			
					)
				));						
			}
			if($GuessAmount == "1")
			{
				$Game_UltimateCodeFile = fopen("LineBotGame_Record\Game_UltimateCode.txt", "w") or die("Unable to open file!");
				fwrite($Game_UltimateCodeFile, ""); 
				fclose($Game_UltimateCodeFile);		
				$client->replyMessage(array(				
				'replyToken' => $event['replyToken'],
				'messages' => array(
				array(
				'type' => 'text', // 訊息類型 (文字)
				'text' => "嫩,一次就爆,你要不要去買樂透阿?" // 回復訊息
						)			
					)
				));									
			}
		}

	}
	else
	{
		$client->replyMessage(array(				
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "請輸入 #數字(EX:#50)" // 回復訊息
				)			
			)
		));
	}
	

}

?>