<?php
date_default_timezone_set('UTC');
/*
In this part I store the 265 phrases in a PHP array and then check the input
string against the phrases in the array. In this way, I don't have to concern
about sanitizing issues. However, it's less efficiency comparing to run queries
in database. If the keyword phrases list contains more data, I would like to uns
mysqli.
*/
if($_GET["search"]!=null){
  //get passed value
  $toMatch=trim($_GET["search"]);
  $lines = file('/fs1/home/xied/public_html/xiedP3/p3-keywordphrases.txt');
  //read in all the kwyword phrases
  foreach ($lines as $line) {
    //search line by line
    $line = trim($line);
    if(strpos($line,$toMatch)===0){
      //match the beginning of each line to user input
             echo $line;
             echo "<br>";
             //show suggestions
           }
         }
       }
 ?>
