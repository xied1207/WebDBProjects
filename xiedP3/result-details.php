<?php
/*
  In this file, do search for the mouse entered record. Display it's details.
*/
date_default_timezone_set('UTC');
//connect to database
  require "/fs1/home/xied/public_html/xiedP3/xied_p3_dbconnect.php";
  //Search passed title;
  //since the title is get from database, it doesn't need senitizing
  if($_POST["search"]!=null){
    $search = $_POST["search"].trim();
    $sql = "select genre, keywords, duration, color, sound, sponsorname from p3records where title='".$search."';";
    $result = $mysqli->query($sql);
    echo "<b>".$search."</b>";
    echo "<br><br>";
    echo "<table id=details>";
    echo "<tbody>";
    //Display search result; use htmlentities and striptags to make sure correct display;
    if($result){
      while($row = $result->fetch_assoc()){
        echo "<tr><td>"."<b>Genre:</b></td><td>".htmlentities(strip_tags($row['genre']))."</td></tr>";
        echo "<tr><td>"."<b>Keywords:</b></td><td>".htmlentities(strip_tags($row['keywords']))."</td></tr>";
        echo "<tr><td>"."<b>Duration:</b></td><td>".htmlentities(strip_tags($row['duration']))."</td></tr>";
        echo "<tr><td>"."<b>Color:</b></td><td>".htmlentities(strip_tags($row['color']))."</td></tr>";
        echo "<tr><td>"."<b>Sound:</b></td><td>".htmlentities(strip_tags($row['sound']))."</td></tr>";
        echo "<tr><td>"."<b>Sponsor:</b></td><td>".htmlentities(strip_tags($row['sponsorname']))."</td></tr>";
      }
    }
    echo "</tbody>";
    echo "</table>";
    //close database
  $mysqli->close();
}
 ?>
