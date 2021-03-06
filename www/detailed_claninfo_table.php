<HTML>
<HEAD>
<TITLE>Welcome to coc.inter-esse.be</TITLE>
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
if(isset($_GET['maxdon'])) {
	$maxdon = $_GET["maxdon"];
} else { 
	$maxdon = 100000;
}
$curdate = date("Y-m-d H:i:s");
$foxforce = new CoC_Clan("#$mytag");

echo "<img src=\"".$foxforce->getBadgeUrl("small")."\" /><h1 style='display:inline'>".$foxforce->getName()."</h1> ".$foxforce->getTag()." - Level: ".$foxforce->getLevel();
echo "<br/>Chocolate Clash: <a target=\"_blank\" href=\"http://www.kuilin.net/cc/clan.php?tag=" . $mytag . "\">" . $foxforce->getTag() . "</a><br/>";
echo "FWA Stats: <a target=\"_blank\" href=\"http://fwastats.azurewebsites.net/Clan/" . $mytag . "\">" . $mytag . "</a><br/>";
echo "Clash of Stats: <a target=\"_blank\" href=\"https://www.clashofstats.com/clans/" . $mytag . "/members\">" . members . "</a><br/>";
echo "<br/>";
echo "Warlog details: <a target=\"_blank\" href=\"warlog_info.php?tag=" . $mytag . "\">" . $foxforce->getTag() . "</a>";
echo "<br/>";
echo "<table border=1><tr><th>#</th><th>Name ($curdate)</th><th>Rank</th><th>Trophies</th><th>Donations</th><th>Donations Received</th><th>Ratio Donations</th></tr>";
foreach ($foxforce->getAllMembers() as $clanmember) 
{
	$member = new CoC_Member($clanmember);
	$donationsReceivedCalc = $member->getDonationsReceived();
	if ($donationsReceivedCalc == 0) $donationsReceivedCalc++;

	$ratio = $member->getDonations() / $donationsReceivedCalc;
    if ( $member->getDonations() <= $maxdon ) {
          $mytag = str_replace("#", "", $member->getTag());
	  echo "<tr><td>".$member->getClanRank()."</td><td>".$member->getName()."</td>";
          echo "<td>".$member->getRole()."</td><td>".$member->getTrophies()."</td><td>".$member->getDonations()."</td><td>".$member->getDonationsReceived()."</td><td>Ratio: ".number_format($ratio, 2)."</td></tr>";
	}  
}
?>
</table>
<br/>
Ratio Donations = Donations / Received Donations (If received donations are 0, 1 will be used to prevent errors.)<br/>
admin = oudste<br/>
<?php
DisplayComment("Increase Page");
IncreasePage($thispage);
DisplayComment("Display views");
DisplayPageViews($thispage);
$conn->close();
?>
