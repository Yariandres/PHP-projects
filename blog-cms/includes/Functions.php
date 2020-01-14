<?php require_once("Includes/DB.php"); ?>


<?php

function Redirect_to($New_location)
{
  header("Location:" . $New_location);
  exit;
}

// checks if user name exists in DB
function CheckUserNameExist($UserName)
{
  global $connectingDB;

  $sql = "SELECT username FROM admins WHERE username=:userName";
  $stmt = $connectingDB->prepare($sql);
  $stmt->bindValue(':userName', $UserName);

  $stmt->execute();
  $Result = $stmt->rowcount();

  if ($Result == 1) {
    return true;
  } else {
    return false;
  }
}
