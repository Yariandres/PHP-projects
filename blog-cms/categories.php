<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php

if (isset($_POST["Submit"])) {
  $Category = $_POST["CategoryTitle"];
  $Admin = "Yari";

  $CurrentTime = time();
  $DateTime = strftime("%d  %B - %Y - %H:%M:%S", $CurrentTime);



  if (empty($Category)) {
    $_SESSION["ErrorMessage"] = "All fields must be filled out";
    Redirect_to("Categories.php");
  } elseif (strlen($Category) < 2) {
    $_SESSION["ErrorMessage"] = "Category title should be greater than 2 charecters";
    Redirect_to("Categories.php");
  } elseif (strlen($Category) > 59) {
    $_SESSION["ErrorMessage"] = "Category title should be less than 50 charecters";
    Redirect_to("Categories.php");
  } else {
    // query to insert category in the DB when everything is fine
    $sql = "INSERT INTO category(title, author, datetime)";
    $sql .= "VALUE(:categoryName, :adminName, :dateTime)";
    $stmt = $connectingDB->prepare($sql);
    $stmt->bindValue(':categoryName', $Category);
    $stmt->bindValue('adminName', $Admin);
    $stmt->bindValue('dateTime', $DateTime);

    $Execute = $stmt->execute();

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Category with id : " . $connectingDB->lastInsertId() . " Added Successfully";
      Redirect_to("Categories.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong, please try again!";
      Redirect_to("Categories.php");
    }
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

  <title>Categories</title>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">Baby Wearing Blog</a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav m-auto">
          <li class="nav-item">
            <a href="myProfile.php" class="nav-link"><i class="fa fa-user text-primary"></i> My Profile</a>
          </li>

          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
          </li>

          <li class="nav-item">
            <a href="posts.php" class="nav-link">Posts</a>
          </li>

          <li class="nav-item">
            <a href="categories.php" class="nav-link">Categories</a>
          </li>

          <li class="nav-item">
            <a href="admin.php" class="nav-link">Manage Admins</a>
          </li>

          <li class="nav-item">
            <a href="comments.php" class="nav-link">Comments</a>
          </li>

          <li class="nav-item">
            <a href="blog.php?page=1" class="nav-link">Live Blog</a>
          </li>
        </ul><!-- /ul  -->

        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="Logout.php" class="nav-link"><i class="fa fa-user-times text-danger"></i>
              Logout</a></li>
        </ul><!-- /ul  -->

      </div><!-- /collapse  -->
    </div><!-- /container  -->
  </nav>
  <!-- /NAVBAR -->

  <!-- HEADER  -->
  <header class="bg-light text-dark my-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="lead"><i class="fa fa-edit"></i> Manage Categories</h1>
        </div>
      </div> <!-- /row  -->
    </div><!-- /container  -->
  </header>
  <!-- /HEADER  -->

  <!-- MAIN  -->
  <div class="section container py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10">

        <!-- displays messages  -->
        <?php

        echo ErrorMessage();
        echo SuccessMessage();

        ?>

        <form action="Categories.php" method="post">
          <div class="card mb-3">

            <div class="card-header">
              <h2 class="lead">Add new category</h2>
            </div>

            <div class="card-body bg-dark">
              <div class="form-group">
                <label class="text-light" for="title"> Category Title</label>
                <input class="form-control" type="text" name="CategoryTitle" id="title">
              </div>

              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i> to dashboard</a>
                </div>

                <div class="col-lg-6">
                  <button type="submit" name="Submit" class="btn btn-success btn-block">
                    <i class="fa fa-check"></i> Publish
                  </button>
                </div>
              </div>

            </div>
          </div>
        </form>

      </div>
    </div><!-- /row  -->
  </div><!-- /container  -->

  <!-- /MAIN  -->


  <!-- FOOTER  -->
  <footer class="bg-dark text-light">
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