<?
error_reporting(0);

function sendMessage($chatID, $messaggio, $token) {
	// https://api.telegram.org/bot658070496:AAE1lQ4Om2KSwOdSgCxlVOEVuiwWgWwIp-Y/getUpdates
	$url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
	$url = $url . "&text=" . urlencode($messaggio);
	$result = file_get_contents($url);
	return $result;
}
$token = "658070496:AAE1lQ4Om2KSwOdSgCxlVOEVuiwWgWwIp-Y";
$chatid = "-417537677";
if (!isset($_SERVER['HTTP_REFERER'])){$_SERVER['HTTP_REFERER']='***';}
$message = "переход с ".$_SERVER['HTTP_REFERER']."
по ключу ".$_GET["ref"]."
User-Agent которого = ".$_SERVER['HTTP_USER_AGENT'];
if($_GET["ref"]!='playfortuna'){sendMessage($chatid, $message, $token);}

$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRjBcGkMvC0EPhwUWGvbNawLhNOgRvofu720FF0swWT-0ujzgDlH-QNrwlprkka6qZ0deyQbyV6C--5/pub?gid=0&single=true&output=tsv";
$currentpage = $_GET["ref"];
$json = file_get_contents($url);
$rows = explode("\r\n", $json);
for ($i=0;$i<count($rows);$i++){
	list ($partnership[$i], $brand[$i], $host[$i], $link[$i]) = explode("\t", $rows[$i]);
	if ($brand[$i]==$currentpage){$selectedraw = $i;}
}
//if($_GET["ref"]=='playfortuna' && date("h")%2==0){$link[$selectedraw]='https://go.gmatrck.info/click?pid=12326&offer_id=2218&l=1588061031';}
header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$link[$selectedraw]);

// https://tuhtdy.ru/fdhstrgh.php?ref=playfortuna
?>