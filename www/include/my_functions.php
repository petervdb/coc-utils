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
}

// Display page views
function DisplayPageViews($page) {
  global $conn;
  DisplayComment($page);
  $sql = "SELECT PaViews from TblPageViews where PaPage = '$page' LIMIT 1;";
  $result = $conn->query($sql);
  // var_dump($result);
  $row = $result->fetch_assoc();
  echo "This page has been viewed ". $row['PaViews'] . " times.</BR>\n";
}
?>
