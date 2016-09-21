<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('coc_utils.sqlite');
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
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      echo "ClTag = ". $row['ClTag'] . "\n";
      echo "ClName = ". $row['ClName'] ."\n";
      echo "ClDescription = ". $row['ClDescription'] ."\n";
      echo "ClType = ". $row['ClType'] ."\n";
      echo "ClLocation = ". $row['ClLocation'] ."\n";
      echo "ClBadgeURL = ". $row['ClBadgeURL'] ."\n";
      echo "ClWarFrequency = ". $row['ClWarFrequency'] ."\n";
      echo "ClClanLevel = ". $row['ClClanLevel'] ."\n";
      echo "ClWarWins = ". $row['ClWarWins'] ."\n";
      echo "ClWarWinStreak = ". $row['ClWarWinStreak'] ."\n";
      echo "ClClanPoints = ". $row['ClClanPoints'] ."\n";
      echo "ClRequiredTrophies = ". $row['ClRequiredTrophies'] ."\n";
      echo "ClMembers = ". $row['ClMembers'] ."\n";
      echo "ClCreated = ". $row['ClCreated'] ."\n";
      echo "ClUpdated =  ".$row['ClUpdated'] ."\n";
      echo "ClActive =  ".$row['ClActive'] ."\n";
      echo "ClQueue =  ".$row['ClQueue'] ."\n\n";
   }
   echo "Operation done successfully\n";
   $db->close();
?>
