<?php
   require_once "../clashapi/api.class.php";
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('priv_clans.sqlite');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   $sql =<<<EOF
      SELECT * from tblClans where ClActive=1;
EOF;

   $ret = $db->query($sql);
   $cur_date = gmdate('Y-m-d H:i:s', time());
   // $cur_date = system("date '+%Y-%m-%d %H:%M:%S'");
   echo "Starting time: $cur_date\n";
   echo "======================================================================\n";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $cur_date = gmdate('Y-m-d H:i:s', time());
      $Clantag = "#".$row['ClTag'];
      $Clantagno = $row['ClTag'];
      // echo "Tag = ". $row['ClTag'] . " Identfied as clan " . $row['ClName'] ."\n";
      // echo "ClDescription = ". $row['ClDescription'] ."\n";
      // echo "ClType = ". $row['ClType'] ."\n";
      // echo "ClLocation = ". $row['ClLocation'] ."\n";
      // echo "ClBadgeURL = ". $row['ClBadgeURL'] ."\n";
      // echo "ClWarFrequency = ". $row['ClWarFrequency'] ."\n";
      // echo "ClClanLevel = ". $row['ClClanLevel'] ."\n";
      // echo "ClWarWins = ". $row['ClWarWins'] ."\n";
      // echo "ClWarWinStreak = ". $row['ClWarWinStreak'] ."\n";
      // echo "ClClanPoints = ". $row['ClClanPoints'] ."\n";
      // echo "ClRequiredTrophies = ". $row['ClRequiredTrophies'] ."\n";
      // echo "ClMembers = ". $row['ClMembers'] ."\n";
      // echo "ClCreated = ". $row['ClCreated'] ."\n";
      // echo "ClUpdated =  ".$row['ClUpdated'] ."\n";
      // echo "ClActive =  ".$row['ClActive'] ."\n";
      // echo "ClQueue =  ".$row['ClQueue'] ."\n\n";
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
      $sqlupd="UPDATE tblClans set ClName = '$ClanName', ClType = '$ClType', ClDescription = '$ClDescription', ClWarWins = $ClWarWins, ClWarWinStreak = $ClWarWinStreak,
        ClClanLevel = $ClLevel, ClClanPoints = $ClPoints, ClMembers = $ClMemberCount, ClUpdated = '$cur_date' where ClTag='$Clantagno'";
      # $sqlupd="UPDATE tblClans set ClName = '$ClanName', ClType = '$ClType',ClUpdated = '$cur_date' WHERE ClTag='$Clantagno'";
      echo "Update statement: $sqlupd\n";
      $ret2 = $db->exec("$sqlupd");
      if(!$ret2){
         echo $db->lastErrorMsg();
      } else {
         echo $db->changes(), " Clan information updated successfully\n";
      }
   }
   echo "Operation done successfully\n";
   $db->close();
   $cur_date = gmdate('Y-m-d H:i:s', time());
   echo "Ending time: $cur_date\n";
   echo "======================================================================\n";
?>
