<?php require_once('common/env.php'); 
header('Content-Type: text/plain; charset=utf-8');

$response = curl(GET_UPDATES);
$getUpdates = json_decode(file_get_contents('common/curl.txt'), true);

file_put_contents('common/curl.txt', json_decode($response));
$getUpdates = json_decode(file_get_contents('common/curl.txt'), true);

$index = count($getUpdates['result']) -1;

// $db = Db::getInstance();

for($i=$index; $i >= 0; $i--){
	$res = $getUpdates['result'][$i];
	
 if(isset($res['message']))
	  $segment =  'message';
  elseif(isset($res['edited_message']))
	  $segment ='edited_message';
  elseif(isset($res['reply_to_message']))
	  $segment = 'reply_to_message';
  elseif(isset($res['my_chat_member']))
	  $segment = 'my_chat_member';  
  
	// $query = $db->first("SELECT * FROM get_updates WHERE message_id = :message_id AND chat_id = :chat_id", array(
			// 'message_id' => $res[$segment]['message_id'],
			// 'chat_id'    => $res[$segment]['chat']['id'],
	// ));
	

// if(!$query){
   // $db->insert("INSERT INTO get_updates (message_id, chat_title, chat_type, chat_id, first_name, username, text, file_id, time) VALUES (:message_id, :chat_title, :chat_type, :chat_id, :first_name, :username, :text, :file_id, :time)", array(
      // 'message_id' => $res[$segment]['message_id'],
      // 'chat_title' => $res[$segment]['chat']['title'],
      // 'chat_type'  => $res[$segment]['chat']['type'],
      // 'chat_id'    => $res[$segment]['chat']['id'],
      // 'first_name' => $res[$segment]['from']['first_name'],
      // 'username'   => $res[$segment]['from']['username'],
      // 'text' 	   => $res[$segment]['text'],
	  // 'file_id'	   => '',
	  // 'time'	   => $res['message']['date'],
    // ));
// }

  echo 'MID: '. ($res[$segment]['message_id']);
  echo '|'. (time_elapsed_string(date('Y-m-d H:i:s', $res['message']['date']), false));
  echo isset($res[$segment]['chat']['title']) ? ' |' . $res[$segment]['chat']['title'] : '';
  echo (isset($res[$segment]['chat']['type']) AND $res[$segment]['chat']['type'] == 'private') ? '|' . $res[$segment]['chat']['type']: '';
  echo '|'.($res[$segment]['chat']['id']);
  echo isset($res[$segment]['from']['username']) ? ' |@'.$res[$segment]['from']['username'] : '';  
  echo '['.$res[$segment]['from']['first_name'].'](tg://user?id='.$res[$segment]['from']['id'].')';
  echo PHP_EOL_BR . '<b>Name: '.($res[$segment]['from']['first_name']) . '</b>' . PHP_EOL_BR;
  echo isset($res[$segment]['text']) ? 'TEXT: '.$res[$segment]['text'] .PHP_EOL_BR : '';
  echo isset($res[$segment]['reply_to_message']) ? '<b>To: '. $res[$segment]['reply_to_message']['from']['first_name'] .': '. $res[$segment]['reply_to_message']['text'] .'</b>' .PHP_EOL_BR: '';
  echo isset($res[$segment]['caption']) ? 'CAPTION: '. $res[$segment]['caption'] .PHP_EOL_BR : '';
  echo isset($res[$segment]['audio']) ? 'audio: '. $res[$segment]['audio']['performer'] . ' | '. $res[$segment]['audio']['title'] .PHP_EOL_BR : '';
  echo isset($res[$segment]['sticker']['emoji']) ? $res[$segment]['sticker']['emoji'] . PHP_EOL_BR : '';
  echo isset($res[$segment]['photo'][1]['file_id']) ? 'Photo File ID: '.  (GET_FILE_URL.$res[$segment]['photo'][1]['file_id']).PHP_EOL_BR : '';
  echo isset($res[$segment]['document']['file_id']) ? 'Document ID: ' .   (GET_FILE_URL.$res[$segment]['document']['file_id']) . PHP_EOL_BR: '';
  echo "---------------------------------------";
  echo PHP_EOL_BR ;
}
?>