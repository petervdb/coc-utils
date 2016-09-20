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
      INSERT INTO tblClans (ClTag,ClName,ClDescription,ClType,ClLocation,ClBadgeURL,ClWarFrequency,ClClanLevel,ClWarWins,ClWarWinStreak,ClClanPoints,ClRequiredTrophies,ClMembers,ClCreated,ClUpdated)
      VALUES ('1111111', 'TestClan', 'First clan','Type','Locatie','http://test','never',1,2,3,4,5,10,'2016-09-20 22:00:00','2016-09-20 22:00:00' );

EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
   $db->close();
?>
