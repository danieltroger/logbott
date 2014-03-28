<?php
set_time_limit(0);
$server = "irc.freenode.org";
$nick = "logbot__";
$channels = array("#channel1","#goeosbottest","#channel3");
$port = 6667;
$connection = fsockopen("$server", $port);

fputs ($connection, "USER $nick $nick $nick $nick :$nick\n");
fputs ($connection, "NICK $nick\n");
foreach($channels as $channel)
{
fputs ($connection, "JOIN {$channel}\n");
}
while(1){
	while($data = fgets($connection)){
		echo nl2br($data);
			
	$a1 = explode(' ', $data);
	$a2 = explode(':', $a1[3]);
	$a3 = explode('@', $a1[0]);
	$a4 = explode('!', $a3[0]);
	$a5 = explode(':', $a4[0]);
	$a6 = explode(':', $data);
	$onlyword = substr($a1[4], 0, -1);
	$user = $a5[1];
	$inchannel = $a1[2];
	$firstword = $a1[4];
	if($a1[0] == "PING"){
		fputs($connection, "PONG ".$a1[1]."\n");
	}
	$args = NULL; for ($i = 4; $i < count($a1); $i++) {$args .= $a1[$i] . ' ';}
	$all = substr($args, 0, -1);
	$len = strlen($firstword) + 1;
	$argsafterfirstword = substr($all,$len);

 	if($a1[0] == "PING"){
			fputs($connection, "PONG ".$a1[1]."\n");
		}     
if (strpos($data, " PRIVMSG {$nick} :leave")!== false){

fputs($connection, "PART {$firstword}\n");
	}
else if (strpos($data, "INVITE {$nick} :")!== false){
$cmd = "JOIN {$a6[2]}";
		fputs($connection, "{$cmd}\n");
echo "{$cmd}\n";
	}
if(in_array($inchannel,$channels))
{
$a13 = substr($a1[3],1);
$log = date("m-d-Y H:i:s \G\M\T P ") . $user . ": " . $a13 . " " . $all;
$url = "http://files.natur-kultur.eu/ul.php?channel=" . urlencode(base64_encode($inchannel)) . "&data=" . urlencode(base64_encode($log));
file_get_contents($url);
}
    
    }
}
?>
