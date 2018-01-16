<?php
  $h = 'pearl.ils.unc.edu';
  $u = 'webdb2';
  $p = 'dxinnku19951207@';
  $dbname = 'webdb2';
  $mysqli = new mysqli($h, $u, $p, $dbname);
  if (mysqli_connect_errno()) {
             echo "connection failed" .mysqli_connect_errno();
             exit();
           }
?>
