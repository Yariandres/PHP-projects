<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
if (isset($_POST["Submit"])) {
  $UserName = $_POST["Username"];
  $Password = $_POST["Password"];

  $Found_Account = Login_Attempt($UserName, $Password);

  if ($Found_Account) {
    $_SESSION["User_ID"] = $Found_Account["id"];
    $_SESSION["UserName"] = $Found_Account["username"];
    $_SESSION["AminName"] = $Found_Account["aname"];

    $_SESSION["SuccessMessage"] = "Wellcome Admin " . $_SESSION["AminName"];

    if (isset($_SESSION["TrackingURL"])) {
      Redirect_to($_SESSION["TrackingURL"]);
    } else {
      Redirect_to("Dashboard.php");
    }
  } else {
    $_SESSION["ErrorMessage"] = "Incorrect Username Or Password";
    Redirect_to("Login.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!--  custom styles -->
  <link rel="stylesheet" href="css/style.css">

  <title>Blog Login</title>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">Baby Wearing Blog</a>
    </div><!-- /container  -->
  </nav><!-- /nav  -->
  <!-- /NAVBAR -->

  <!-- HEADER  -->
  <header class="my-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="lead text-center">Welcome Back!</h1>
        </div>
      </div> <!-- /row  -->
    </div><!-- /container  -->
  </header>
  <!-- /header  -->
  <!-- /HEADER  -->



  <!-- MAIN  -->
  <section class="container signin">
    <form action="Login.php" method="post" class="form-signin">
      <!-- alert messages -->
      <?php
      echo ErrorMessage();
      echo SuccessMessage();
      ?>
      <input type="text" id="username" class="form-control" name="Username" placeholder="Email address">

      <input type="password" id="password" class="form-control" name="Password" placeholder="Password">

      <button type="submit" name="Submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
    </form><!-- /form  -->
  </section><!-- /section  -->
  <!-- /MAIN -->

  <!-- FOOTER  -->
  <footer class="bg-dark text-light mastfoot mt-auto">
    <div class="container">
      <div class="row">
        <div class="col">
          <p class="lead text-center my-auto">
            Theme By <a href="https://www.linkedin.com/in/yari-herrera-9677a9160/" target="_blank">Yari Herrera </a>|
            All rights reserved | &copy; <span id="year"></span>
          </p>
        </div><!-- /col  -->
      </div><!-- /row  -->
    </div><!-- /container  -->

  </footer>
  <!-- /FOOTER  -->



  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <script>
    // gets span location 
    let span = document.querySelector('#year');
    // new year object stored 
    let date = new Date();
    // gets year 
    let year = date.getFullYear();

    // writes year into span 
    span.innerText = year;
  </script>
</body>

</html>