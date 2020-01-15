<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- checks if logged in or not  -->
<?php
if (isset($_GET["id"])) {
  $SearchQueryPerameter = $_GET["id"];

  // connects to DB 
  global $connectingDB;

  // gets admin name
  $Admin = $_SESSION["AminName"];

  $sql = "UPDATE comments SET status='OFF', approvedby='$Admin' WHERE id='$SearchQueryPerameter'";
  $Execute = $connectingDB->query($sql);

  if ($Execute) {
    $_SESSION["SuccessMessage"] = "Comment Dis-approved Successfully";
    Redirect_to("Comments.php");
  } else {
    $_SESSION["ErrorMessage"] = "Something went wrong";
  }
}
?>