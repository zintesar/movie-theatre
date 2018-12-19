<?php
  if (session_status() == PHP_SESSION_NONE) {
  session_start();}
session_unset();
$_SESSION['admin_flag']=0;
$_SESSION['user_flag']=0;
header("location:index.php");
?>
