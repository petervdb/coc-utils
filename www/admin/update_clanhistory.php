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
   echo "Starting time: $cur_date\n";
   echo "======================================================================\n";
   while($row = $result->fetch_assoc()) {
      $cur_date = gmdate('Y-m-d H:i:s', time());
      $Clantag = "#".$row['ClTag'];
      $Clantagno = $row['ClTag'];
      echo "Tag = ". $row['ClTag'] . " Identfied as clan " . $row['ClName'] ."\n";
      $clan = new CoC_Clan("$Clantag");
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
      $sqlupd=" INSERT into TblClansHist 
      (ClHiDate, ClHiTag, ClHiName, ClHiType, ClHiWarWins, ClHiWarWinStreak, ClHiClanLevel, ClHiClanPoints, ClHiMembers)
      values ( '$cur_date', '$Clantagno', '$ClanName', '$ClType', $ClWarWins, $ClWarWinStreak, $ClLevel, $ClPoints, $ClMemberCount);";
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
?>
