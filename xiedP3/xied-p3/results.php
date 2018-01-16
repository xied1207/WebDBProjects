<html>
<head>
<meta charset="utf-8">
<title>Open Video</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> </script>
<script src="https://opal.ils.unc.edu/~xied/xiedP3/result.js"></script>
</head>
<body>
<header align="right">
  <?php
  //Connect to session
  //show the login information, show logout function.
  session_start();
  echo 'Hello, '.$_SESSION['valid_user'].'<a href="https://opal.ils.unc.edu/~xied/xiedP3/logout.php"> logout</a>';
   ?>
</header>
<div id="header">
<h1 align="middle">Open Video</h1>
</div>

<div id="searchFunction" style="width: 15%;height: 100%;float: left;">
<div id="search">
  <form id="searchForm" method="get" action="results.php">
  <input id="inputSearch" name="searchWord" type="text" style="width:90%; height:25px;"/>
  <p>
  <input type="submit" value="search">
  </form>
</div>
<div id=suggestionbox>
Suggestions:
<div id="suggestion">

</div>
</div>
</div>
<div id="result" style="width: 60%;height: 100%;float: left;">
<?php
/*
In this file, do main search, use search word to get data from database. display
search result.
*/
//session_start();
if (isset($_SESSION['valid_user'])){
//connect to database
  require '/fs1/home/xied/public_html/xiedP3/xied_p3_dbconnect.php';
  //doing main search function
  if($_GET['searchWord']!=null){
    $search = $mysqli->real_escape_string(trim($_GET['searchWord']));
    //sanitizing passed search word
    $sql = 'select title, substr(description,1,200) as des from p3records where match (title,description,keywords) against ("'.$search.'");';
    $result = $mysqli->query($sql);
    echo 'Showing results for: '.htmlentities($_GET['searchWord']);
    echo '<br><br>';
    if($result){
      //display search result
      while($row = $result->fetch_assoc()){
        echo '<table class=searchResult>';
        echo '<tbody>';
        echo '<tr class=resultTitle style="font-weight: bold;"><td>'.htmlentities(strip_tags($row['title'])).'</td></tr>';
        echo '<tr><td>'.htmlentities(strip_tags($row['des'])).'</td></tr>';
        echo '<tr><td>&nbsp</td></tr>';
        echo '</tbody>';
        echo '</table>';
      }
    }else{
      echo 'no record in Database';
    }
    //close database
  $mysqli->close();
}
}else{
  //if no session, change to home page(login page)
  header("Location: https://opal.ils.unc.edu/~xied/xiedP3/home.html");
  exit;
}
 ?>
 </tbody>
 </table>
</div>

<div id="detail" style="width: 25%;height: 100%;position: relative;float: right;">

</div>
</body>
</html>
