<?php
require_once('common/env.php');

if(isset($_REQUEST['DELETE_MESSAGE']) AND $_REQUEST['DELETE_MESSAGE'] == 'true'){
	$message_data = explode('/', str_replace('https://t.me/c/', '',$_REQUEST['message_id']));
	if(isset($_REQUEST['group']) AND $_REQUEST['group'] == 'on'){
		$message_data[0] = '-100'.$message_data[0];
	}
	
	if(isset($_REQUEST['chat_id'])){
		$message_data[1] = $_REQUEST['message_id'];
		$message_data[0] = $_REQUEST['chat_id'];
		
		$messageId = explode('/', $_REQUEST['message_id'])[5];
		
		$all = $messageId;
		
		for($i=$all; $i >= $all-50; $i--){
			curl(DELETE_MESSAGE.'?chat_id='.$message_data[0].'&message_id='.$i);			
		}
		header("Location:". BASE_URL);
	}
	
	curl(DELETE_MESSAGE.'?chat_id='.$message_data[0].'&message_id='.$message_data[1]);
	header("Location:". BASE_URL);
}


if(isset($_REQUEST['REPEAT_MESSAGE'])){
	$count = $_REQUEST['count'];
		for($i=$count; $i >= 1; $i--){
		curl(SEND_MESSAGE.'?chat_id='.$_REQUEST['chat_id'].'&text='.$_REQUEST['text'] . '&reply_to_message_id='.$_REQUEST['reply_to_message_id']. '&parse_mode=markdown');
		sleep(4);
		}
		
		header("Location:". BASE_URL);		
}


if(isset($_REQUEST['SEND_MESSAGE'])){
	$message_data = explode('/', str_replace('https://t.me/c/', '',$_REQUEST['reply_to_message_id']));
	
	if(!isset($message_data[1])){
		$message_data[1] = $message_data[0];
		$message_data[0] = $_REQUEST['chat_id'];
	}
	
	if(isset($_REQUEST['group']) AND $_REQUEST['group'] == 'on'){
		
		$message_data[0] = '-100'.str_replace('-100', '', $message_data[0]);
	}
		curl(SEND_MESSAGE.'?chat_id='.$message_data[0].'&text='.$_REQUEST['text']. '&reply_to_message_id='.$message_data[1].'&parse_mode=markdown');
		header("Location:". BASE_URL);		
}



if(isset($_REQUEST['UPLOAD_PHOTO'])){
	
	$message_data = explode('/', str_replace('https://t.me/c/', '',$_REQUEST['reply_to_message_id']));
	if(isset($_REQUEST['group']) AND $_REQUEST['group'] == 'on'){
		$message_data[0] = '-100'.$message_data[0];
	}
	uploadImage(SEND_PHOTO,$_FILES['photo']['tmp_name'], $message_data[0]);
	header("Location:". BASE_URL);
}



if(isset($_REQUEST['SEND_MESSAGE_TO_ADMINISTRATOR'])){
	$result = curl(SEND_MESSAGE_TO_ADMINISTRATOR.'?chat_id='.$_REQUEST['chat_id']);
	file_put_contents('chat_id/'.$_REQUEST['chat_id'].'.json', json_decode($result));
	$res = json_decode(file_get_contents('chat_id/'.$_REQUEST['chat_id'].'.json'), true);
		
	$text= $_REQUEST['text'];
	
	foreach($res['result'] as $re){
		$first_name = str_replace('#', '', $re['user']['first_name']);
		$text.= " [{$first_name}](tg://user?id={$re['user']['id']})";
	}

	exit(SEND_MESSAGE.'?chat_id='.$_REQUEST['chat_id'].'&text='.$text.'&parse_mode=markdown');	
	header("Location:". BASE_URL);
}