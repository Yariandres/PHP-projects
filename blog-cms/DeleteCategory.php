<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- checks if logged in or not  -->
<?php
if (isset($_GET["id"])) {
  $SearchQueryPerameter = $_GET["id"];

  // connects to DB 
  global $connectingDB;

  $sql = "DELETE FROM category WHERE id='$SearchQueryPerameter'";
  $Execute = $connectingDB->query($sql);

  if ($Execute) {
    $_SESSION["SuccessMessage"] = "Category Deleted Successfully";
    Redirect_to("Categories.php");
  } else {
    $_SESSION["ErrorMessage"] = "Something went wrong, try again";
    Redirect_to("Categories.php");
  }
}
?>