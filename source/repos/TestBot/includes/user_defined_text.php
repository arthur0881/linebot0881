<?php

$DoneEdit = false; 
$DoneDelete = false;
$ReadyToWrite = true;  
$SearchResult = false;

//讀檔案到 $LoadFile 陣列內
$LoadFile = file("user_defined_text.txt");
fclose($User_Defined_TextFile);	
 
if(strpos($message['text'],'!') !== false && strpos($message['text'],';') !== false)
{
	$StringText = explode(';',$message['text']);	
	if(Count($StringText) == 2 && trim($StringText[1]) == "")
	{
		$SetInput = preg_replace('/\s(?=)/', '', trim($StringText[0]));
		if($SetInput != "!")
		{
			$SearchText = preg_replace('/!/', '', $SetInput);
			foreach($LoadFile as $value)
			{
				if($SearchText == trim(explode('|_|',$value)[0]))
				{
					$SearchResult = true;
					$client->replyMessage(array(
					'replyToken' => $event['replyToken'],
					'messages' => array(
					array(
					'type' => 'text', // 訊息類型 (文字)
					'text' => trim(explode('|_|',$value)[1]) // 回復訊息 
							)			
						)
					));
					break;
				}
			}
			if($SearchResult == false)
			{
				$client->replyMessage(array(
				'replyToken' => $event['replyToken'],
				'messages' => array(
				array(
				'type' => 'text', // 訊息類型 (文字)
				'text' => "未定義,要新增請用'!新增;".$SearchText // 回復訊息
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
			'text' => "說人話好嗎?" // 回復訊息
					)			
				)
			));		
		}
	}
}
	
//使用者自定義字串 寫入
if(strpos($message['text'],'!新增;') !== false)
{
	$StringText = explode(';',$message['text']);
	if(Count($StringText) == 3)
	{
		$SetInput = preg_replace('/\s(?=)/', '', trim($StringText[1]));
		$SetOutput = preg_replace('/\s(?=)/', '', trim($StringText[2]));
		
	if(Count($LoadFile) > 0)
	{
		foreach($LoadFile as $value)
		{
			if(trim(explode('|_|',$value)[0]) == $SetInput)
			{
				$ReadyToWrite = false;	
				break;				
			}
		}
		if($ReadyToWrite == true)
		{
			$User_Defined_TextFile = fopen("user_defined_text.txt", "a") or die("Unable to open file!");
			fwrite($User_Defined_TextFile, $SetInput."|_|".$SetOutput."\n"); // 輸入文字/輸出文字
			fclose($User_Defined_TextFile);	
			$client->replyMessage(array(
			'replyToken' => $event['replyToken'],
			'messages' => array(
			array(
			'type' => 'text', // 訊息類型 (文字)
			'text' => "記錄成功" // 回復訊息
					)			
				)
			));		
		}	
		else		
		{
			$client->replyMessage(array(
			'replyToken' => $event['replyToken'],
			'messages' => array(
			array(
			'type' => 'text', // 訊息類型 (文字)
			'text' => "紀錄已存在,要修改請用'!修改;".$SetInput // 回復訊息
					)			
				)
			));	
		}
	}
	else
	{
		$User_Defined_TextFile = fopen("user_defined_text.txt", "a") or die("Unable to open file!");
		fwrite($User_Defined_TextFile, $SetInput."|_|".$SetOutput."\n"); // // 輸入文字/輸出文字
		fclose($User_Defined_TextFile);	
		$client->replyMessage(array(
		'replyToken' => $event['replyToken'],
		'messages' => array(
		array(
		'type' => 'text', // 訊息類型 (文字)
		'text' => "記錄成功" // 回復訊息
				)			
			)
		));	
	}			
	}
}
//使用者自定義字串 修改
if(strpos($message['text'],'!修改;') !== false)
{
	$Array_Count = 0;
	$StringText = explode(';',$message['text']);
	if(Count($StringText) == 3)
	{
		$UpdateInput = preg_replace('/\s(?=)/', '', trim($StringText[1]));
		$UpdateOutput = preg_replace('/\s(?=)/', '', trim($StringText[2]));
		if(Count($LoadFile) > 0)
		{
			unlink("user_defined_text.txt");
			$User_Defined_TextFile = fopen("user_defined_text.txt", "a") or die("Unable to open file!");
			foreach($LoadFile as $value)
			{
				if(trim(explode('|_|',$value)[0]) == $UpdateInput)
				{
					fwrite($User_Defined_TextFile, $UpdateInput."|_|".$UpdateOutput."\n"); // 輸入文字/輸出文字					
					$DoneEdit = true;
					$client->replyMessage(array(
					'replyToken' => $event['replyToken'],
					'messages' => array(
					array(
					'type' => 'text', // 訊息類型 (文字)
					'text' => "修改完成" // 回復訊息
							)			
						)
					));	
				}
				else
				{
					fwrite($User_Defined_TextFile, $value); // 輸入文字/輸出文字
				}
			}
			fclose($User_Defined_TextFile);	
			if($DoneEdit == false)
			{
				$client->replyMessage(array(
				'replyToken' => $event['replyToken'],
				'messages' => array(
				array(
				'type' => 'text', // 訊息類型 (文字)
				'text' => "無符合修改項目,要新增請用'!新增;".$UpdateInput // 回復訊息
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
		'text' => "無符合修改項目,要新增請用'!新增;".$UpdateInput // 回復訊息
				)			
			)
		));	
	}
	
	}	
}

//使用者自定義字串 刪除
if(strpos($message['text'],'!刪除;') !== false)
{
	$Array_Count = 0;
	$StringText = explode(';',$message['text']);
	if(Count($StringText) >= 2)
	{
		$DeleteInput = preg_replace('/\s(?=)/', '', trim($StringText[1]));
		if(Count($LoadFile) > 0)
		{
			unlink("user_defined_text.txt");
			$User_Defined_TextFile = fopen("user_defined_text.txt", "a") or die("Unable to open file!");
			foreach($LoadFile as $value)
			{
				if(trim(explode('|_|',$value)[0]) == $DeleteInput)
				{
					unset($value);
					$DoneDelete = true;
					$client->replyMessage(array(
					'replyToken' => $event['replyToken'],
					'messages' => array(
					array(
					'type' => 'text', // 訊息類型 (文字)
					'text' => "刪除完成" // 回復訊息
							)			
						)
					));	
				}
				else
				{
					fwrite($User_Defined_TextFile, $value); // 輸入文字/輸出文字
				}
			}
			fclose($User_Defined_TextFile);	
			if($DoneDelete == false)
			{
				$client->replyMessage(array(
				'replyToken' => $event['replyToken'],
				'messages' => array(
				array(
				'type' => 'text', // 訊息類型 (文字)
				'text' => "無符合刪除項目" // 回復訊息
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
		'text' => "無符合刪除項目" // 回復訊息
				)			
			)
		));
	}
	
	}	
}

//密技 全刪除
if($message['text'] == "密傳檔案全殺")
{
	unlink("user_defined_text.txt");
	$User_Defined_TextFile = fopen("user_defined_text.txt", "a") or die("Unable to open file!");
	fclose($User_Defined_TextFile);	
	$client->replyMessage(array(
	'replyToken' => $event['replyToken'],
	'messages' => array(
	array(
	'type' => 'text', // 訊息類型 (文字)
	'text' => "暗黑兔兔無限破!!!!!!" // 回復訊息
			)			
		)
	));
}

//密技 全查詢
if($message['text'] == "密傳檔案讀取")
{
	$AllText = "";
	 foreach($LoadFile as $value){	
		$AllText = $AllText.trim($value)."@#@";	
	 }	
	$client->replyMessage(array(
	'replyToken' => $event['replyToken'],
	'messages' => array(
	array(
	'type' => 'text', // 訊息類型 (文字)
	'text' => $AllText // 回復訊息
			)			
		)
	));
}

//密技 全新增(因為Heroku的機八政策 會改動的東西每次上傳都會被清空 所以只能自己加回來)
if(strpos($message['text'],'!密傳完全建置;') !== false)
{
	$StringText = explode(';',$message['text']);
	$TargetText = explode('@#@',trim($StringText[1]));	
	$User_Defined_TextFile = fopen("user_defined_text.txt", "a") or die("Unable to open file!");
	 foreach($TargetText as $value){	
		$ReAddText = explode('|_|',trim($value));	
		fwrite($User_Defined_TextFile, trim($ReAddText[0])."|_|".trim($ReAddText[1])."\n"); // 輸入文字/輸出文字
	 }	
	 fclose($User_Defined_TextFile);	
	 	$client->replyMessage(array(
	'replyToken' => $event['replyToken'],
	'messages' => array(
	array(
	'type' => 'text', // 訊息類型 (文字)
	'text' => "天堂兔兔無限破!!!!!!" // 回復訊息
			)			
		)
	));

}

?>