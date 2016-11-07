<?php

require_once "clashapi/api.class.php";
$mytag = $_GET["tag"];

$api = new ClashOfClans();
if($api->isWarlogPublic("#$mytag"))
{
	$warlog = new CoC_Warlog($api->getWarlog("#$mytag", array("limit" => 20)));
        echo "War log history<br>";
	for ($i = 0; $i < $warlog->getLogEntryAmount(); $i++) 
	{ 
		$logEntry = new CoC_LogEntry($warlog->getLogEntryByIndex($i));
		if($logEntry->getResult() == "win")
		{
			echo '<font color="green">';
		}
		else if($logEntry->getResult() == "lose")
		{
			echo '<font color="red">';
		}
		else if($logEntry->getResult() == "draw")
		{
			echo '<font color="black">';
		}
		echo $logEntry->getClanName() . " " . $logEntry->getClanStars() . " - " . $logEntry->getOpponentStars() . " " . $logEntry->getOpponentName() . " </font><br/>";
	}
}
else
{
	echo "This clan's warlog isn't public, sorry.";
}

?>
