<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
$_SESSION["User_ID"] = null;
$_SESSION["UserName"] = null;
$_SESSION["AminName"] = null;
session_destroy();
Redirect_to("Login.php");
?>