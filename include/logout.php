<?php 
ob_start();
session_start();

$_SESSION['username'] = null;
$_SESSION['password'] = null;
$_SESSION['user_firstname'] = null;
$_SESSION['user_lastname'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_role'] = null;

header("Location: ../")

?>