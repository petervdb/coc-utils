<?php
  require_once "../clashapi/api.class.php";
  require "../include/config.php";
  $conn = new mysqli($servername, $dbuser, $dbpassword, $db);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * from TblClans where ClActive=1";
  $result = $conn->query($sql);

  $cur_date = gmdate('Y-m-d H:i:s', time());
  // $cur_date = system("date '+%Y-%m-%d %H:%M:%S'");

  echo "Starting time: $cur_date\n";
  echo "======================================================================\n";
  if ($result->num_rows > 0) {
     // output data of each row// output data of each row
     while($row = $result->fetch_assoc()) {
      $cur_date = gmdate('Y-m-d H:i:s', time());
      $Clantag = "#".$row['ClTag'];
      $Clantagno = $row['ClTag'];
      echo "Tag = ". $row['ClTag'] . " Identfied as clan " . $row['ClName'] ."\n";
      $clan = new CoC_Clan("$Clantag");
      // echo "<img src=\"".$clan->getBadgeUrl("small")."\"\n";
      // echo $clan->getTag() . "\n";
      echo "Clan identified as: " . $clan->getName();
      echo "\n----------------------------------\n";
      $ClanName = $clan->getName();
      $ClType = $clan->getType();
      $ClWarWins = $clan->getWarWins();
      $ClWarWinStreak = $clan->getWarWinStreak();
      $ClLevel = $clan->getLevel();
      $ClPoints = $clan->getPoints();
      $ClMemberCount = $clan->getMemberCount();
      $ClDescription = strip_tags($clan->getDescription());
      $sqlupd="UPDATE TblClans set ClName = '$ClanName',
        ClType = '$ClType', ClDescription = 'NA', ClWarWins = $ClWarWins,
        ClWarWinStreak = $ClWarWinStreak, ClClanLevel = $ClLevel,
        ClClanPoints = $ClPoints, ClMembers = $ClMemberCount,
        ClUpdated = '$cur_date' where ClTag='$Clantagno';";
      if ($conn->query($sqlupd) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
     }
   echo "Operation done successfully\n";
   $conn->close();
   $cur_date = gmdate('Y-m-d H:i:s', time());
   echo "Ending time: $cur_date\n";
   echo "======================================================================\n";
  }
?>
