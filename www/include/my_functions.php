<?php
// Get filename
function GetFilename($myfile) {
  return basename($_SERVER['PHP_SELF']);
}

// Place comment
function DisplayComment($comment = "unknown" ) {
  echo "\n<!-- =============================== Comment: $comment -->\n";
}

// Increase the page views
function IncreasePage($page) {
  global $conn;
  $cur_date = gmdate('Y-m-d', time());
  $sql = "SELECT PaPage from TblPageViews where PaPage = '$page';";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    //Page exists, increase page views
    $sql = "UPDATE TblPageViews SET PaViews = PaViews + 1 WHERE PaPage = '$page';";
    $conn->query($sql);
  } else {
    // Page does not exist in table, add it
    $sql = "INSERT INTO TblPageViews (PaPage,PaViews) VALUES('$page',0);";
    $conn->query($sql);
    $sql = "UPDATE TblPageViews SET PaViews = PaViews + 1 WHERE PaPage = '$page';";
    $conn->query($sql);
  }
  $sql = "SELECT PaHiPage from TblPageHistory where PaHiPage = '$page' and PaHiDate = '$cur_date';";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    //Page exists, increase page views
    $sql = "UPDATE TblPageHistory SET PaHiViews = PaHiViews + 1 WHERE PaHiPage = '$page' and PaHiDate = '$cur_date';";
    $conn->query($sql);
  } else {
    // Page does not exist in table, add it
    $sql = "INSERT INTO TblPageHistory (PaHiPage,PaHiViews,PaHiDate) VALUES('$page',0,'$cur_date');";
    $conn->query($sql);
    $sql = "UPDATE TblPageHistory SET PaHiViews = PaHiViews + 1 WHERE PaHiPage = '$page' and PaHiDate = '$cur_date';";
    $conn->query($sql);
  }
  $sql = "SELECT PaHiPage from TblPageHistory where PaHiPage = '$page' and PaHiDate = '$cur_date';";
}

// Display page views
function DisplayPageViews($page) {
  global $conn;
  $cur_date = gmdate('Y-m-d', time());
  DisplayComment($page);
  $sql = "SELECT PaViews from TblPageViews where PaPage = '$page' LIMIT 1;";
  $result = $conn->query($sql);
  // var_dump($result);
  $row1 = $result->fetch_assoc();
  $sql = "SELECT PaHiViews from TblPageHistory where PaHiPage = '$page' and PaHiDate = '$cur_date' LIMIT 1;";
  $result = $conn->query($sql);
  // var_dump($result);
  $row2 = $result->fetch_assoc();
  echo "This page has been viewed ". $row1['PaViews'] . " times from which are " . $row2['PaHiViews'] . " today.</BR>\n";
}
?>
