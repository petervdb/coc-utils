<HTML>
<HEAD>
<TITLE>Welkom op coc.inter-esse.be</TITLE>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</HEAD>
<BODY>
<?php

require_once "clashapi/api.class.php";
include_once "include/config.php";
include_once "include/my_functions.php";
$thispage=basename($_SERVER['PHP_SELF']);
// Create connection
$conn = new mysqli($servername, $dbuser, $dbpassword, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
DisplayComment("Increase Page");
IncreasePage($thispage);
DisplayComment("Display views");
DisplayPageViews($thispage);
$conn->close();
?>
