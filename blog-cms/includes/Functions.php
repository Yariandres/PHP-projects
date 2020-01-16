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

// fectches posts from DB
function TotalPosts()
{
  // connecting DB 
  global $connectingDB;

  // counts al table in DB
  $sql = "SELECT COUNT(*) FROM posts";

  $stmt = $connectingDB->query($sql);

  // fetches as array 
  $TotalRows = $stmt->fetch();

  // converts to string
  $TotalPosts = array_shift($TotalRows);

  echo $TotalPosts;
}


// fectches categories from DB
function TotalCategories()
{
  // connecting DB 
  global $connectingDB;

  // counts al table in DB
  $sql = "SELECT COUNT(*) FROM category";

  $stmt = $connectingDB->query($sql);

  // fetches as array 
  $TotalRows = $stmt->fetch();

  // converts to string
  $TotalCategories = array_shift($TotalRows);

  echo $TotalCategories;
}

// fectches admins, from DB
function TotalAdmins()
{
  // connecting DB 
  global $connectingDB;

  // counts al table in DB
  $sql = "SELECT COUNT(*) FROM admins";

  $stmt = $connectingDB->query($sql);

  // fetches as array 
  $TotalRows = $stmt->fetch();

  // converts to string
  $TotalAmins = array_shift($TotalRows);

  echo $TotalAmins;
}


// fectches comments from DB
function TotalComments()
{
  // connecting DB 
  global $connectingDB;

  // counts al table in DB
  $sql = "SELECT COUNT(*) FROM comments";

  $stmt = $connectingDB->query($sql);

  // fetches as array 
  $TotalRows = $stmt->fetch();

  // converts to string
  $TotalComments = array_shift($TotalRows);

  echo $TotalComments;
}

// gets comments per post 
function ApprovedComments($PostId)
{
  // connects to DB 
  global $connectingDB;

  $sql_Approve = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
  $stmt_Approve = $connectingDB->query($sql_Approve);

  // returns array
  $RowsTotal = $stmt_Approve->fetch();

  // converts to string to use it
  $Total = array_shift($RowsTotal);

  return $Total;
}

function DisApprovedComments($PostId)
{
  // connects to DB 
  global $connectingDB;

  $sql_DisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
  $stmt_DisApprove = $connectingDB->query($sql_DisApprove);

  // returns array
  $RowsTotal = $stmt_DisApprove->fetch();

  // converts to string to use it
  $Total = array_shift($RowsTotal);

  return $Total;
}
