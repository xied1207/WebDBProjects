<?php
/*
In this file, I make a logout function.
*/
session_start();
$old_user = $_SESSION['valid_user'];
//empty the session
$_SESSION = array();
//expire the session
if (isset($_COOKIE[session_name()])) {
setcookie(session_name(), '', time()-42000, '/'); }
session_destroy();
?>
<h1>Logout</h1>
<?php
if (!empty($old_user)) {
echo "You are now logged out.<br>";
} else {
echo "You were not logged in.<br>";
}
?>
<a href="https://opal.ils.unc.edu/~xied/xiedP3/home.html">Home page</a>
