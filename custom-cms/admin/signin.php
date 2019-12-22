<?php 
session_start();

include_once "includes/config.php";
include_once "includes/db.php";

if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($db , $_POST['email']);
  $password = mysqli_real_escape_string($db , $_POST['password']);

  $query = "SELECT * FROM admin WHERE email='$email' AND password='$password' ";
  $result = $db->query($query);

  if($result->num_rows == 1) {
    $_SESSION['email'] = $email;
    header("Location:index.php");
    exit();
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>
  <body class="text-center">

      <form class="form-signin" method="POST">
        <img class="mb-4" src="" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Sign in?</h1>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        
        
      <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>

      <p class="mt-5 mb-3 text-muted" id="date"></p>
  </form>

  <script src="js/script.js"></script>
</body>
</html>
