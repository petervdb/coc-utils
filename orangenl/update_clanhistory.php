<?php
   require_once "../clashapi/api.class.php";
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('orangenl.sqlite');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   $sql =<<<EOF
      SELECT * from tblClans;
EOF;

   $ret = $db->query($sql);
   $cur_date = gmdate('Y-m-d H:i:s', time());
   echo "Starting time: $cur_date\n";
   echo "======================================================================\n";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
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
      $sqlupd=<<<EOF
      INSERT into tblClanshist (ClHiDate, ClHiTag, ClHiName, ClHiType, ClHiWarWins, ClHiWarWinStreak, ClHiClanLevel, ClHiClanPoints, ClHiMembers)
      values ( '$cur_date', '$Clantagno', '$ClanName', '$ClType', $ClWarWins, $ClWarWinStreak, $ClLevel, $ClPoints, $ClMemberCount);
EOF;

      $ret2 = $db->exec($sqlupd);
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
