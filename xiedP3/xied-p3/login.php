<?php
/*
In this file, I checked the authority of current user to figure out if this
person has a record in our user database.
*/
require '/fs1/home/xied/public_html/xiedP3/xied_p3_dbconnect.php';
//connect to the database
if($_POST["user"]!=null and $_POST["pass"]!=null){
  $username=$mysqli->real_escape_string($_POST['user']);
  //use mysqli:real escape string function to avoid sanitizing before run in SQL
  $password=sha1($_POST['pass']);
  /*
  use sha1 method to create a enciphered string(to match the enciphered string
  I saved in database)
  */
  $check= "SELECT * FROM users WHERE username='$username' AND password='$password';";
  //echo $check;
  $result = $mysqli->query($check);
  if(($result->num_rows > 0)) {
    //echo "it's our user!";
    //it the user existed in our database, jump to results.php page
    //save the user in session
    session_start();
    $_SESSION['valid_user'] = $username;
    $sid = session_id();
    header("Location: https://opal.ils.unc.edu/~xied/xiedP3/results.php");
    exit;
     }else{
    //the user don't exist. We allow input username and password again
    echo "This user does not exist. Please try again";
    echo '<br>';
    echo '<a href="https://opal.ils.unc.edu/~xied/xiedP3/home.html">Home page</a>';
  }
}else{
  //username and password are not correctly input. Prompt to type in again.
  echo 'Invalid input!';
  echo '<br>';
  echo '<a href="https://opal.ils.unc.edu/~xied/xiedP3/home.html">Home page</a>';
}
?>
