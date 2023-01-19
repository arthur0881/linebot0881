<?php

$Asking = false;

//讀檔案到 $LoadFileUltCode 陣列內
$LoadFileUltCode = file("LineBotGame_Record\Game_UltimateCode.txt");
$LoadFileGuessNumber = file("LineBotGame_Record\Game_GuessNumber.txt");
	
//遊戲 : 終極密碼
if($message['text'] == '!終極密碼' && trim($LoadFileUltCode[0]) != 'StartGame' && $Asking == false)
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

if($message['text'] == '!終極密碼結束' && trim($LoadFileUltCode[0]) == 'StartGame')
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
if($message['text'] == '!終極密碼結束' && trim($LoadFileUltCode[0]) != 'StartGame')
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
if($message['text'] == '!終極密碼狀態' && trim($LoadFileUltCode[0]) == 'StartGame')
{
	$Asking = true;
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "遊戲進行中，"."數字在".trim((string)$LoadFileUltCode[2])."到".trim((string)$LoadFileUltCode[3])."之間" // 回復訊息
				)			
			)
		));
}
if($message['text'] == '!終極密碼狀態' && trim($LoadFileUltCode[0]) != 'StartGame')
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

if(trim($LoadFileUltCode[0]) == 'StartGame' && $Asking == false && strpos($message['text'],'#') !== false)
{
	$InputNumber = explode('#',$message['text']);
	$Input = $InputNumber[1];
	if(strlen($Input) == strlen((string)((int)$Input))){
		$GuessNumber = trim((int)$Input);
		$TargetCode = trim((string)$LoadFileUltCode[1]);
		$MinNumber = trim((string)$LoadFileUltCode[2]);
		$MaxNumber = trim((string)$LoadFileUltCode[3]);
		$GuessAmount = trim((string)$LoadFileUltCode[4]);
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
				$LoadFileUltCode = file("LineBotGame_Record\Game_UltimateCode.txt");
				$MinNumber = trim((string)$LoadFileUltCode[2]);
				$MaxNumber = trim((string)$LoadFileUltCode[3]);
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


//遊戲 : 猜數字
if($message['text'] == '!猜數字' && trim($LoadFileGuessNumber[0]) != 'StartGameGuessNumber' && $Asking == false)
{
	$TargetNumber = "";
	$GuessTime = 0;
	for($i = 0; $i < $i + 1; $i++)
	{
		$temp = (string)rand(0,9);
		if(strpos($TargetNumber,$temp) !== false)
		{			
			continue;
		}
		else
		{
			$TargetNumber = $TargetNumber.$temp;
		}
		
		if(strlen($TargetNumber) == 4)
		{
			break;
		}
	}
	
	$Game_GuessNumberFile = fopen("LineBotGame_Record\Game_GuessNumber.txt", "w") or die("Unable to open file!");
	fwrite($Game_GuessNumberFile, "StartGameGuessNumber\n"); // Array[0] 遊戲開始了沒
	fwrite($Game_GuessNumberFile, $TargetNumber."\n");//Array[1] 目標數字
	fwrite($Game_GuessNumberFile, $GuessTime."\n");//Array[2] 目標數字
	fclose($Game_GuessNumberFile);
			$client->replyMessage(array(
			'replyToken' => $event['replyToken'],
			'messages' => array(
			array(
			'type' => 'text', // 訊息類型 (文字)
			'text' => "遊戲開始,請輸入 @不重複數字(EX:@1234)" // 回復訊息
					)			
				)
			));
}

if($message['text'] == '!猜數字結束' && trim($LoadFileGuessNumber[0]) == 'StartGameGuessNumber')
{
	$Asking = true;
	$Game_GuessNumberFile = fopen("LineBotGame_Record\Game_GuessNumber.txt", "w") or die("Unable to open file!");
	fwrite($Game_GuessNumberFile, ""); 
	fclose($Game_GuessNumberFile);	
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
if($message['text'] == '!猜數字結束' && trim($LoadFileGuessNumber[0]) != 'StartGameGuessNumber')
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
if(trim($LoadFileGuessNumber[0]) == 'StartGameGuessNumber')
{
	if(strpos($message['text'],'@') !== false)
	{
	$InputNumber = explode('@',$message['text']);
	$message['text'] = $InputNumber[1];
	$FirstTextZero = false;
	if(str_split($message['text'])[0] == '0')
	{
		if(strlen($message['text']) == strlen((string)((int)$message['text'])) + 1)
		{
			$FirstTextZero = true;
		}
	}

	if(strlen($message['text']) == strlen((string)((int)$message['text'])) || $FirstTextZero == true){
		$GuessNumber = trim((int)$message['text']);
		$TargetNumber = trim((string)$LoadFileGuessNumber[1]);
		$GuessTime = trim((string)$LoadFileGuessNumber[2]);
		
		$InputNumberArray = str_split($GuessNumber);
		$TargetNumberArray = str_split($TargetNumber);
		$AfterRemove = array_unique($InputNumberArray);
		
		if(Count($InputNumberArray) == Count($AfterRemove))
		{
			$AmountOf_A = 0;
			$AmountOf_B = 0;
		for($m = 0;$m < 4; $m++)
		{
			if($InputNumberArray[$m] == $TargetNumberArray[$m])
			{
				$AmountOf_A++;
			}
			else
			{
				for($n = 0;$n < 4; $n++)
				{
					if($InputNumberArray[$m] == $TargetNumberArray[$n])
					{
						$AmountOf_B++;
					}
				}
			}			
		}			
			
			if($AmountOf_A != 4){
				$Game_GuessNumberFile = fopen("LineBotGame_Record\Game_GuessNumber.txt", "w") or die("Unable to open file!");
				fwrite($Game_GuessNumberFile, "StartGameGuessNumber\n"); // Array[0] 遊戲開始了沒
				fwrite($Game_GuessNumberFile, $TargetNumber."\n");//Array[1] 目標數字
				fwrite($Game_GuessNumberFile, (string)((int)$GuessTime+1)."\n");//Array[2] 目標數字
				fclose($Game_GuessNumberFile);
				if((int)$GuessTime+1 < 10)
				{
					$text = $AmountOf_A."A".$AmountOf_B."B\n目前猜了".(int)($GuessTime+1)."次";
					$client->replyMessage(array(
					'replyToken' => $event['replyToken'],
					'messages' => array(
					array(
					'type' => 'text', // 訊息類型 (文字)
					'text' => preg_replace('/<br\\s*?\/??>/i','',nl2br(trim($text)))
							)			
						)
					));					
				}
				else
				{
					$Game_GuessNumberFile = fopen("LineBotGame_Record\Game_GuessNumber.txt", "w") or die("Unable to open file!");
					fwrite($Game_GuessNumberFile, ""); 
					fclose($Game_GuessNumberFile);		
					$text = "答案是".$TargetNumber."\n已經猜了".(int)($GuessTime+1)."次,遊戲結束";
					$client->replyMessage(array(
					'replyToken' => $event['replyToken'],
					'messages' => array(
					array(
					'type' => 'text', // 訊息類型 (文字)
					'text' => preg_replace('/<br\\s*?\/??>/i','',nl2br(trim($text)))
							)			
						)
					));						
				}
			}
			else
			{
				$Game_GuessNumberFile = fopen("LineBotGame_Record\Game_GuessNumber.txt", "w") or die("Unable to open file!");
				fwrite($Game_GuessNumberFile, ""); 
				fclose($Game_GuessNumberFile);	
					$text = "正確答案!!!\n總共猜了".(int)($GuessTime+1)."次";
					$client->replyMessage(array(
					'replyToken' => $event['replyToken'],
					'messages' => array(
					array(
					'type' => 'text', // 訊息類型 (文字)
					'text' => preg_replace('/<br\\s*?\/??>/i','',nl2br(trim($text)))
							)			
						)
					));							
			}

		}
		else
		{
			$client->replyMessage(array(
			'replyToken' => $event['replyToken'],
			'messages' => array(
			array(
			'type' => 'text', // 訊息類型 (文字)
			'text' => "請輸入 @不重複數字(EX:@1234)"
					)			
				)
			));		
		}


	}
	else
	{
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "請輸入 @不重複數字(EX:@1234)"
				)			
			)
		));		
	}
	
	}
}

?>