<HTML>
<HEAD>
<TITLE>Welkom op coc.inter-esse.be</TITLE>
</HEAD>
<BODY>
<H1>Welkom op coc.inter-esse.be</H1>
<p>
Ben je op zoek naar een Orange clan, dan ben je hier aan het juiste adres.<BR>
Het overzicht hieronder is niet helemaal up-to-date. Er is een vertraging mogelijk die kan oplopen tot een paar uur.<BR> Naast elke clan staat het tijdstip vermeld wanneer deze het laatst werd nagezien.<BR>
De Tag link is dat wel. De Kuilin link is de Chocolate Clash databank.<BR>
Een overzicht van alle clans die momenteel periodiek worden bijgehouden:<BR>
<?php
  include_once "include/config.php";
  include_once "include/my_functions.php";
  $thispage=basename($_SERVER['PHP_SELF']);
  // Create connection
  $conn = new mysqli($servername, $dbuser, $dbpassword, $db);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  $sql = "SELECT ClTag, ClName, ClDescription,ClType,ClWarWins,ClWarWinStreak,ClClanLevel,ClClanPoints,ClMembers,ClUpdated from TblClans where ClActive=1 order by ClName;";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      echo "<table border=1>";
      echo "<tr><td>Tag</td><td>Kuilin</td><td>Name</td><td>Type</td><td>War Wins</td><td>Win Streaks<td>Level</td><td>Points</td><td>Members</td><td>Laatste update</td></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<td><a target=\"_blank\" href=\"detailed_claninfo.php?tag=" . $row["ClTag"] . "\">" . $row["ClTag"] . "</a></td>";
        echo "<td><a target=\"_blank\" href=\"http://www.kuilin.net/cc/clan.php?tag=" . $row["ClTag"] . "\">" . $row["ClTag"] . "</a></td>";
        echo "<td>".$row["ClName"]."</td>";
        echo "<td>".$row["ClType"]."</td>";
        echo "<td>".$row["ClWarWins"]."</a></td>";
        echo "<td>".$row["ClWarWinStreak"]."</td>";
        echo "<td>".$row["ClClanLevel"]."</td>";
        echo "<td>".$row["ClClanPoints"]."</td>";
        echo "<td>".$row["ClMembers"]."</td>";
        echo "<td>".$row["ClUpdated"]."</td>";
        echo "</tr>";
      }
      echo "</table><br/><hr>";
      echo "Donation Ratio = donations made / donations received (if received = 0, use 1 instead to prevent errors)<br/>";
      echo "admin = elder";
  } else {
    echo "0 results";
  }
?>
<BR><BR>Een heel gedetaileerd overzicht van de clan kan je in de volgende link vinden, maar het duurt ongeveer 1 minuut om de pagina te genereren:<BR>
<?php
  echo "<a target=\"_blank\" href=\"examples/claninformation_orange.php" .  "\">" . "Gedetailleerd overzicht alle NL Orange clans" . "</a><BR>";
  DisplayComment("Increase Page");
  IncreasePage($thispage);
  DisplayComment("Display views");
  DisplayPageViews($thispage);
  $conn->close();
?>
</BODY>
</HTML>
