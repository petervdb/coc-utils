<HTML>
<HEAD>
<TITLE>Welcome on coc.inter-esse.be</TITLE>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</HEAD>
<BODY>
<H1>Welcome on coc.inter-esse.be</H1>
<p>
This page contains some clans on Clash Of Clans which are interesting for me and where I have been active from time to time.<BR>
Most clans are farming clans which are active in Orange, Griffin of FWA. But it could also be that they do normal wars.<BR>
This page gets automatically updated from time to time. There can be a delay of a few hours.<BR>
Next to each clan you can see when it has been updated.<BR>
When you click on the tag and see details about the clan, that information is a realtime status of the clan. The Kuilin link is the link to Chocolate Clash databank.<BR>
That link is only interesting if you have interests in farm wars and it's history.<BR>
Overview clans:<BR>
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
      echo "<tr><td>Tag</td><td>Kuilin</td><td>FWA Stats</td><td>ClashOfStats</td><td>Name</td><td>Type</td><td>War Wins</td><td>Win Streaks<td>Level</td><td>Points</td><td>Members</td><td>Laatste update</td></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<td><a target=\"_blank\" href=\"detailed_claninfo.php?tag=" . $row["ClTag"] . "\">" . $row["ClTag"] . "</a></td>";
        echo "<td><a target=\"_blank\" href=\"http://www.kuilin.net/cc/clan.php?tag=" . $row["ClTag"] . "\">" . $row["ClTag"] . "</a></td>";
        echo "<td><a target=\"_blank\" href=\"http://fwastats.azurewebsites.net/Clan/" . $row["ClTag"] . "\">" . $row["ClTag"] . "</a></td>";
        echo "<td><a target=\"_blank\" href=\"https://www.clashofstats.com/clans/" . $row["ClTag"] . "/members\">" . members . "</a></td>";
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
<BR>
<?php
  DisplayComment("Increase Page");
  IncreasePage($thispage);
  DisplayComment("Display views");
  DisplayPageViews($thispage);
  $conn->close();
?>
</BODY>
</HTML>
