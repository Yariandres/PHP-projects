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

// check for duplicate record 
function Login_Attempt($UserName, $Password)
{
  global $connectingDB;
  $sql = "SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
  $stmt = $connectingDB->prepare($sql);
  $stmt->bindValue(':userName', $UserName);
  $stmt->bindValue(':passWord', $Password);
  $stmt->execute();

  $Result = $stmt->rowcount();

  if ($Result == 1) {
    return $Found_Account = $stmt->fetch();
  } else {
    return null;
  }
}

// checks if user is logged in access granteed otherwise login is required 
function Confirm_Login()
{
  if (isset($_SESSION["User_ID"])) {
    return true;
  } else {
    $_SESSION["ErrorMessage"] = "Login Required";
    Redirect_to("Login.php");
  }
}
