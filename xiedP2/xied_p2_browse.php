<head>
<link rel="stylesheet" type="text/css" href="xied_p2_styles.css">
</head>
<h1>Digital Library Browser</h1>
<table>
<tbody>
  <tr>
    <td><a href="xied_p2_browse.php?thepage=1&&sortby=authors">Author(s)</a></td>
    <td><a href="xied_p2_browse.php?thepage=1&&sortby=title">Title</a></td>
    <td><a href="xied_p2_browse.php?thepage=1&&sortby=publication">Publication</a></td>
    <td><a href="xied_p2_browse.php?thepage=1&&sortby=year">Year</a></td>
    <td><a href="xied_p2_browse.php?thepage=1&&sortby=type">Type</a></td>
    </tr>

<?php
//connect to database
  require "/fs1/home/xied/public_html/xiedP2/xied_p2_dbconnect.php";
//create a new column to get lastname of first author
  $addlname="ALTER TABLE p2records ADD COLUMN lastname varchar(100)";
  $add1="UPDATE p2records SET lastname=
              substring_index(left(authors,instr(authors,' and')-1),' ',-1)
              WHERE instr(authors,' and')>0 and itemnum>0";
  $add2="UPDATE p2records SET lastname=
              substring_index(authors,' ',-1)
              WHERE instr(authors,' and')=0 and itemnum>0";
  $mysqli->query($addlname);
  $mysqli->query($add1);
  $mysqli->query($add2);
  //use get method to pass sorting information
  if($_GET["sortby"]){
      $sortby = $_GET["sortby"];
      if($sortby=="authors"){
        $sortby="lastname";
      }
  }else{$sortby = "itemnum";}
  //count how many records in the table, decide pages
  $sql = "select * from p2records order by ";
  $sql = $sql.$sortby;
  $result = $mysqli->query($sql);
  $r_count = $result->num_rows;
  $pagenum = ceil($r_count/25);
  //use get method to pass paging information
  if($_GET["thepage"]){
      $startpage = $_GET["thepage"];
  }else{$startpage =1;}
  $start=($startpage-1)*25;
  //execute query to display records
  $sql=$sql." limit ".$start.",25";
  $result = $mysqli->query($sql);
  if($result){
    while($row = $result->fetch_assoc()){
      echo "<tr><td>".$row['authors']."</td><td><a href=".$row['url'].">";
      echo $row['title']."</a>";
      echo "</td><td>".$row['publication'];
      echo "</td><td>".$row['year']."</td><td>".$row['type']."</td></tr>";
    }
  }else{
      echo "browsing failed";
    }
    //delete the column to save lastname of first author
    $droplname="ALTER TABLE p2records DROP COLUMN lastname";
    $mysqli->query($droplname);
    //close database
    $mysqli->close();
echo "</tbody>";
echo "</table>";
echo "<br/>";
//generate paging marks
if($startpage==1){
    echo '[1] ';
    for($n=2;$n<=$pagenum;$n++){
      echo '<a href="xied_p2_browse.php?thepage='.$n.
      '&&sortby='.$sortby.'">'.$n.' </a>';
}
}else{
  for($n=1;$n<$startpage;$n++){
    echo '<a href="xied_p2_browse.php?thepage='.$n.
    '&&sortby='.$sortby.'">'.$n.' </a>';
  }
  echo '['.$startpage.'] ';
  for($n=$startpage+1;$n<=$pagenum;$n++){
    echo '<a href="xied_p2_browse.php?thepage='.$n.
    '&&sortby='.$sortby.'">'.$n.' </a>';
  }
}
?>
