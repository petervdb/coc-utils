<?php
  require_once "../clashapi/api.class.php";
  require "../include/config.php";
  // var_dump($argv);
  if ($argc == 2) {
    switch ($argv[1]) {
      case "updhist":
        $updhist = 1;
        break;
    }
  } else {
    $updhist = 0;
  }
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
      // Before inserting all members, we should first delete all inserted members for that clan
      $sqldel="DELETE FROM TblMembers where MbClTag = '$Clantagno';";
      echo "Deleting members with clan tag ". $row['ClTag'] . "\n";
      if ($conn->query($sqldel) === TRUE) {
        echo "Clan members deleted successfully\n";
      } else {
        echo "Error deleting clan records: " . $conn->error . "\n";
      }
      foreach ($clan->getAllMembers() as $clanmember)
      {
        $member = new CoC_Member($clanmember);
        $donationsReceivedCalc = $member->getDonationsReceived();
        if ($donationsReceivedCalc == 0) $donationsReceivedCalc++;

        $ratio = $member->getDonations() / $donationsReceivedCalc;
        $mytag = str_replace("#", "", $member->getTag());
        $mbclanrank = $member->getClanRank();
        $mbname = $member->getName();
        $mbname = str_replace( "'", "", $mbname );
        $mbname = str_replace( '"', "", $mbname );
        // $mbname = "NA";
        $mbtag = $member->getTag(); 
        $mblevel = $member->getLevel(); 
        $mbleagueid = $member->getLeagueId(); 
        $mbrole = $member->getRole(); 
        $mbtrophies = $member->getTrophies(); $mbdonations = $member->getDonations(); 
        $mbreceived = $member->getDonationsReceived();
        $sqlupd="INSERT INTO TblMembers (MbTag, MbName, MbClTag,MbRole,MbLevel,MbLeagueId,MbLeague,MbTrophies,
          MbClanRank,MbDonations,MbReceived,MbCreated,MbUpdated,MbActive,MbQueue) values
          ('$mytag','$mbname', '$Clantagno','$mbrole','$mblevel','$mbleagueid',0,'$mbtrophies',
          0,'$mbdonations','$mbreceived',now(),now(),1,1);";
        if ($conn->query($sqlupd) === TRUE) {
          echo "Record ($mytag - $mbname) inserted successfully\n";
        } else {
          echo "Error inserting record ($mytag - $mbname) : " . $conn->error . "\n";
        }
      }
      if ($updhist == 1) {
        // Update the history table
        $sqlhistupd="insert into TblMembersHist (select MbUpdated, MbTag, MbName, MbClTag,MbRole,MbLevel,MbLeagueId,MbLeague,MbTrophies,MbClanRank,MbDonations,MbReceived from TblMembers);";
        // if ($conn->query($sqlhistupd) === TRUE) {
          // echo "History table updated successfully\n";
        // } else {
          // echo "Error updating history table: " . $conn->error . "\n";
        // }
      } else {
        echo "History table update disabled\n";
      }
      echo "Operation done successfully\n";
      $cur_date = gmdate('Y-m-d H:i:s', time());
      echo "Ending time: $cur_date\n";
      echo "======================================================================\n";
     }
  }
$conn->close();
?>
