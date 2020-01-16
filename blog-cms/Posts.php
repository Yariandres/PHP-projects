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
  <title>Posts</title>
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
          <h1 class="display-4 my-5">Blog Posts</h1>
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
      <div class="col-sm-8 col-md-8 col-lg-12">

        <!-- alert messages  -->
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>

        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>Live Preview</th>
            </tr>
          </thead><!-- /thead  -->
          <?php
          global $connectingDB;
          $sql = "SELECT * FROM posts";
          $stmt = $connectingDB->query($sql);
          $Sr = 0;
          while ($DataRows = $stmt->fetch()) {
            $Id       = $DataRows["id"];
            $DateTime = $DataRows["datetime"];
            $PostTile = $DataRows["title"];
            $Category = $DataRows["category"];
            $Admin    = $DataRows["author"];
            $Image    = $DataRows["image"];
            $PostText = $DataRows["post"];
            $Sr++;
          ?>
            <tbody>
              <tr>
                <td><?php echo $Sr; ?></td>
                <td>
                  <!-- checks if title is loger than 10 charecters -->
                  <?php if (strlen($PostTile) > 10) {
                    $PostTile = substr($PostTile, 0, 10) . '...';
                  }
                  echo $PostTile;
                  ?>
                </td>
                <td>
                  <!-- checks if category name is loger than 10 charecters -->
                  <?php if (strlen($Category) > 6) {
                    $Category = substr($Category, 0, 6) . '...';
                  }
                  echo $Category;
                  ?>
                </td>
                <td>
                  <!-- checks if date & time name is loger than 10 charecters -->
                  <?php if (strlen($DateTime) > 11) {
                    $DateTime = substr($DateTime, 0, 11) . '...';
                  }
                  echo $DateTime; ?>
                </td>
                <td><?php echo $Admin; ?></td>
                <td><img src="Uploads/<?php echo $Image; ?>" width="100" height="70" class="img-thumbnail"></td>

                <td>
                  <!-- SPAN  -->
                  <?php
                  $Total = ApprovedComments($Id);

                  // if 0 comments dont show count <span>
                  if ($Total > 0) {
                    echo '<span class="badge badge-success">' . $Total . '</span>';
                  } else {
                    echo '<span> </span>';
                  }
                  ?>
                  <!-- /SPAN  -->

                  <!-- SPAN  -->
                  <?php

                  $Total = DisApprovedComments($Id);

                  // if 0 comments dont show count <span>
                  if ($Total > 0) {
                    echo '<span class="badge badge-danger">' . $Total . '</span>';
                  } else {
                    echo '<span> </span>';
                  }
                  ?>
                  <!-- /SPAN  -->
                </td>

                <td>
                  <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                  <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                </td>
                <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
              </tr>
            </tbody><!-- /tbody  -->
          <?php } ?>

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