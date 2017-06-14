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
   } else {
      echo "Opened database successfully\n";
   }
   echo "Please specify the clan tag without the # sign: ";
   $handle = fopen ("php://stdin","r");
   $line = fgets($handle);
   $clan = trim($line);
   fclose($handle);
   if (empty($clan)) {
     echo "Nothing to delete to the database. Exiting.\n";
     exit;
   } else {
     echo "Deleting $clan from the database ... \n";
   }
   $cur_date = gmdate('Y-m-d H:i:s', time());
   $sql =<<<EOF
delete from tblClans where ClTag = '$clan';
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records deleted successfully\n";
   }
   $db->close();
?>
