<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'matrimony');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());

if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { sendChat(); } 
if ($_GET['action'] == "closechat") { closeChat(); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 
if ($_GET['action'] == "chatname") { chatName(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat() {
	$sql = "select register.username,register.gender,register.photo1,chat.from,chat.message,chat.to,chat.id,chat.sent,chat.recd from chat,register where (chat.to = '".mysql_real_escape_string($_SESSION['chatuser'])."' AND recd = 0) and chat.from=register.index_id order by id ASC";
	
	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}
		
		$chat['message'] = sanitize($chat['message']);
		
		if($chat['photo1']=='')
		{
			 if($chat['gender']=='Male')
			 {
			 $chat['photo1']="male_small.png";
			 } 		
			 else
			 {
			 $chat['photo1']= "female_small.png";
			 }			
		}
		

		$items .= <<<EOD
					   {
			"s": "0",
			"u": "{$chat['username']}",
			"ph": "{$chat['photo1']}",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"u": "{$chat['username']}",
			"f": "{$chat['from']}",
			"ph": "{$chat['photo1']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($_SESSION['chatuser'])."' and recd = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
/*
$suser=$_SESSION['chatuser'];
$sc=mysql_query("select username from register where username='$su'");
while($row_sc=mysql_fetch_array($sc))
{
$_SESSION['current_chat_username']=$row_sc['username'];
}*/
?>
{
		"username": "<?php echo $_SESSION['chatuser'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php
	exit(0);
	
}

function chatName() {
	$un = '';
	
$su=$_GET['usw'];
$sc2=mysql_query("select username from register where uid='$su' limit 1");
while($row_sc2=mysql_fetch_array($sc2))
{
$un=$row_sc2["username"];
}
?>
{
		"unm": ["<?php echo $un;?>"]
		
}

<?php


	exit(0);
}



function sendChat() {
	$from = $_SESSION['chatuser'];
	$to = $_POST['to'];
	$message = $_POST['message'];
	$sql = "select register.username from register where register.index_id='$from' limit 1";
	$uname = mysql_query($sql);
	$from_user='';
	while ($un = mysql_fetch_array($uname)) {
	$from_user=$un['username'];
	}
	
	
	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"u": "{$from_user}",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);

	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
	$query = mysql_query($sql);
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}
?>
