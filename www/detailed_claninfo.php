<?php
require_once "clashapi/api.class.php";

$mytag = $_GET["tag"];
if(isset($_GET['maxdon'])) {
	$maxdon = $_GET["maxdon"];
} else { 
	$maxdon = 100000;
}

$foxforce = new CoC_Clan("#$mytag");

echo "<img src=\"".$foxforce->getBadgeUrl("small")."\" /><h1 style='display:inline'>".$foxforce->getName()."</h1> ".$foxforce->getTag()." - Level: ".$foxforce->getLevel();
echo " - Chocolate Clash: <a target=\"_blank\" href=\"http://www.kuilin.net/cc/clan.php?tag=" . $mytag . "\">" . $foxforce->getTag() . "</a>";
echo "<br/>";
echo "Warlog details: <a target=\"_blank\" href=\"warlog_info.php?tag=" . $mytag . "\">" . $foxforce->getTag() . "</a>";
echo "<br/>";
echo "<table border=1><tr><th>#</th><th>Naam</th><th>Tag Kuilin</th><<th>Rang</th><th>Bekers</th><th>Donaties</th><th>Ontvangen Donaties</th><th>Verhouding Donaties</th></tr>";
foreach ($foxforce->getAllMembers() as $clanmember) 
{
	$member = new CoC_Member($clanmember);
	$donationsReceivedCalc = $member->getDonationsReceived();
	if ($donationsReceivedCalc == 0) $donationsReceivedCalc++;

	$ratio = $member->getDonations() / $donationsReceivedCalc;
    if ( $member->getDonations() <= $maxdon ) {
          $mytag = str_replace("#", "", $member->getTag());
	  echo "<tr><td>".$member->getClanRank()."</td><td>".$member->getName()."</td>";
          echo "<td><a target=\"_blank\" href=\"http://www.kuilin.net/cc/member.php?tag=" . $mytag . "\">" . $member->getTag() . "</a></td>";
          echo "<td>".$member->getRole()."</td><td>".$member->getTrophies()."</td><td>".$member->getDonations()."</td><td>".$member->getDonationsReceived()."</td><td>Verhouding: ".number_format($ratio, 2)."</td></tr>";
	}  
}

?>
</table>
<br/>
Verhouding Donaties = Donaties / Ontvangen Donaties (Als ontvangen donaties 0 is wordt 1 gebruikt om fouten te vermijden)<br/>
admin = oudste
