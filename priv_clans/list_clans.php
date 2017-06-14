<?php
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
   } 

   $sql =<<<EOF
      SELECT ClTag, ClName from tblClans order by ClName;
EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      echo "Clan : ". $row['ClName'] . " - " . $row['ClTag'] . "\n";
   }
   $db->close();
?>
