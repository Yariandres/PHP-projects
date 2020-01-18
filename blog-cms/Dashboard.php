<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- checks if logged in or not  -->
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
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

  <title>Dashboard</title>
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
            <a href="Dashboard.php" class="nav-link">Dashboard</a>
          </li>

          <li class="nav-item">
            <a href="Posts.php" class="nav-link">Posts</a>
          </li>

          <li class="nav-item">
            <a href="Categories.php" class="nav-link">Categories</a>
          </li>

          <li class="nav-item">
            <a href="Admins.php" class="nav-link">Manage Admins</a>
          </li>

          <li class="nav-item">
            <a href="Comments.php" class="nav-link">Comments</a>
          </li>

          <li class="nav-item">
            <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
          </li>
        </ul><!-- /ul  -->

        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa fa-user-times text-danger"></i>
              Logout</a></li>
        </ul><!-- /ul  -->

      </div><!-- /collapse  -->
    </div><!-- /container  -->
  </nav>
  <!-- /NAVBAR -->

  <!-- HEADER  -->
  <header class="bg-light text-dark mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="lead my-5">Blog Dashboard</h1>
        </div>

        <div class="col-lg-3">
          <a href="AddNewPost.php" class="btn btn-primary btn-block mb-2">
            <i class="fa fa-edit"></i> Add new post
          </a>
        </div><!-- /col-lg-3  -->


        <div class="col-lg-3">
          <a href="Categories.php" class="btn btn-info btn-block mb-2">
            <i class="fa fa-folder"></i> Add new Category
          </a>
        </div><!-- /col-lg-3  -->

        <div class="col-lg-3">
          <a href="Admins.php" class="btn btn-warning btn-block mb-2">
            <i class="fa fa-user"></i> Add new Admin
          </a>
        </div><!-- /col-lg-3  -->

        <div class="col-lg-3">
          <a href="Comments.php" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> Approve Comments
          </a>
        </div><!-- /col-lg-3  -->

      </div> <!-- /row  -->
    </div><!-- /container  -->
  </header>
  <!-- /HEADER  -->

  <!-- MAIN  -->
  <section class="container mb-5">
    <div class="row">
      <!-- alert messages  -->
      <?php
      echo ErrorMessage();
      echo SuccessMessage();
      ?>
      <!-- LEFT SIDE  -->
      <div class="col-lg-2">
        <div class="card text-center bg-dark text-light">
          <div class="card-body">
            <h1 class="lead">Posts</h1>
            <h4 class="lead">
              <i class="fa fa-book"></i>
              <?php
              TotalPosts();
              ?>
            </h4>
          </div><!-- /card-body  -->
        </div><!-- /card  -->

        <div class="card text-center bg-dark text-light">
          <div class="card-body">
            <h1 class="lead">Categories</h1>
            <h4 class="lead">
              <i class="fa fa-folder"></i>
              <?php
              TotalCategories();
              ?>
            </h4>
          </div><!-- /card-body  -->
        </div><!-- /card  -->

        <div class="card text-center bg-dark text-light">
          <div class="card-body">
            <h1 class="lead">Admins</h1>
            <h4 class="lead">
              <i class="fa fa-user"></i>
              <?php
              TotalAdmins();
              ?>
            </h4>
          </div><!-- /card-body  -->
        </div><!-- /card  -->

        <div class="card text-center bg-dark text-light">
          <div class="card-body">
            <h1 class="lead">Comments</h1>
            <h4 class="lead">
              <i class="fa fa-comments"></i>
              <?php
              TotalComments();
              ?>
            </h4>
          </div><!-- /card-body  -->
        </div><!-- /card  -->

      </div><!-- /col  -->

      <!-- RIGHT SIDE  -->
      <div class="col-lg-10">
        <h1 class="lead">
          Top Posts
        </h1>
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Comments</th>
              <th>Details</th>
            </tr>
          </thead> <!-- /thead  -->

          <?php

          // connects to DB 
          global $connectingDB;

          $SrNo = 0;

          $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,9";
          $stmt = $connectingDB->query($sql);

          while ($DataRows = $stmt->fetch()) {
            $PostId = $DataRows["id"];
            $DateTime = $DataRows["datetime"];
            $Author = $DataRows["author"];
            $Title = $DataRows["title"];
            $SrNo++;

          ?>
            <tbody>
              <tr>
                <td><?php echo htmlentities($SrNo); ?></td>
                <td><?php echo htmlentities($Title); ?></td>
                <td><?php echo htmlentities($DateTime); ?></td>
                <td><?php echo htmlentities($Author); ?></td>
                <td>
                  <!-- SPAN  -->
                  <?php
                  $Total = ApprovedComments($PostId);

                  // if 0 comments dont show count <span>
                  if ($Total > 0) {
                    echo '<span class="badge badge-success">' . $Total . '</span>';
                  } else {
                    echo '<span> </span>';
                  }
                  ?>
                  <!-- /SPAN  -->

                  <!-- SPAN -->
                  <?php

                  $Total = DisApprovedComments($PostId);

                  // if 0 comments dont show count <span>
                  if ($Total > 0) {
                    echo '<span class="badge badge-danger">' . $Total . '</span>';
                  } else {
                    echo '<span> </span>';
                  }
                  ?>
                  <!-- /SPAN -->
                </td>

                <td>
                  <a href="FullPost.php?id=<?php echo $PostId; ?>" target="_blank">
                    <span class="btn btn-info">Preview</span>
                  </a>
                </td>
              </tr>
            </tbody>

          <?php } ?>
          <!-- end-while loop  -->

        </table><!-- /table  -->
      </div><!-- /col  -->


    </div><!-- /row  -->
  </section><!-- /section  -->
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