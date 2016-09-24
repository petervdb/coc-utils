<?php
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
   echo "Please specify the clan tag without the # sign: ";
   $handle = fopen ("php://stdin","r");
   $line = fgets($handle);
   $clan = trim($line);
   fclose($handle);
   if (empty($clan)) {
     echo "Nothing to add to the database. Exiting.\n";
     exit;
   } else {
     echo "Adding $clan to the database ... \n";
   }
   $cur_date = gmdate('Y-m-d h:i:s', time());
   $sql =<<<EOF
insert into tblClans (ClTag,ClName,ClDescription,ClType,ClLocation,ClBadgeURL,ClWarFrequency,ClClanLevel,ClWarWins,ClWarWinStreak,ClClanPoints,ClRequiredTrophies,ClMembers,ClCreated,ClUpdated) VALUES ('$clan', '$clan', '','','','','',0,0,0,0,0,0,'$cur_date','$cur_date' );
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
   $db->close();
?>
