
<?php
error_reporting(0);
require_once('common/setting.php');

define('PHP_EOL_BR', '<br>'.PHP_EOL);
define('GET_FILE_URL',  'https://api.telegram.org/bot'.BOT_TOKEN.'/getFile?file_id=');
define('GET_UPDATES',   'https://api.telegram.org/bot'.BOT_TOKEN.'/getUpdates');
define('SEND_MESSAGE',  'https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage');
define('SEND_PHOTO',    'https://api.telegram.org/bot'.BOT_TOKEN.'/sendPhoto');
define('DELETE_MESSAGE','https://api.telegram.org/bot'.BOT_TOKEN.'/deleteMessage');
define('SEND_MESSAGE_TO_ADMINISTRATOR','https://api.telegram.org/bot'.BOT_TOKEN.'/getChatAdministrators');

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function curl($targetUrl, $params = ''){
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'mirror.rahnama.com',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => array('targetUrl' => $targetUrl,'params' => $params),
	));

		$response = curl_exec($curl);
		curl_close($curl);
		
	return $response;
}

function uploadImage($url, $photo, $chat_id){

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => array('photo'=> new CURLFILE('$photo'), 'chat_id' => $chat_id),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;
}

function create_groups($section){
		$chat_ids = file_get_contents('common/chat_ids');	
	  foreach(json_decode($chat_ids) as $j){
		echo "<label for='{$j->name} {$section}'>{$j->name}</label>
		<input class='radios {$section}' id='{$j->name} {$section}' type='radio' name='chat_id' value='{$j->chat_id}'>
		<br>";
	}
}