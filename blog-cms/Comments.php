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

  <title>Blog Comments</title>
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
            <a href="blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
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
  <header class="bg-light text-dark my-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4">Manage Comments</h1>
        </div>

      </div> <!-- /row  -->
    </div><!-- /container  -->

  </header>
  <!-- /HEADER  -->

  <!--  -->
  <section class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="lead">Un-Approved Comments</h2>
        <!-- displays messages  -->
        <?php

        echo ErrorMessage();
        echo SuccessMessage();
        ?>

        <!-- APPROVED TABLE -->
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Comment</th>
              <th>Approve</th>
              <th>Action</th>
              <th>Details</th>
            </tr>
          </thead><!-- /thead  -->

          <?php
          // connects to the DB
          global $connectingDB;

          // gets comments with the status OFF 
          $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
          $Execute = $connectingDB->query($sql);

          $SrNo = 0;

          while ($DataRows = $Execute->fetch()) {
            $CommentId = $DataRows["id"];
            $DateTimeOfComment = $DataRows["datetime"];
            $CommenterName = $DataRows["name"];
            $CommentContent = $DataRows["comment"];
            $CommentPostId = $DataRows["post_id"];
            $SrNo++;

            // shortens the name of the commentor to fit the table cell
            if (strlen($CommenterName) > 10) {
              $CommenterName = substr($CommenterName, 0, 10) . '...';
            }
            // shortens the datetime to fit the table cell
            if (strlen($DateTimeOfComment) > 11) {
              $DateTimeOfComment = substr($DateTimeOfComment, 0, 11) . '...';
            }

          ?>

            <tbody>
              <tr>
                <td><?php echo htmlentities($SrNo++); ?></td>
                <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                <td><?php echo htmlentities($CommenterName); ?></td>
                <td><?php echo htmlentities($CommentContent); ?></td>
                <td><a class="btn btn-success" href="ApproveComments.php?id=<?php echo $CommentId; ?>">Approve</a></td>
                <td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId; ?>">Delete</a></td>
                <td style="min-width: 140px" style="min-width: 140px"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
              </tr>

            </tbody><!-- /tbody  -->
          <?php } ?>
          <!-- end-while loop  -->
        </table><!-- /table  -->

        <!-- DIS-APPROVED TABLE -->
        <h2 class="lead">Approved Comments</h2>
        <table class="table table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Date & Time</th>
              <th>Author</th>
              <th>Comment</th>
              <th>Revert</th>
              <th>Action</th>
              <th>Details</th>
            </tr>
          </thead><!-- /thead  -->

          <?php
          // connects to the DB
          global $connectingDB;

          // gets comments with the status OFF 
          $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
          $Execute = $connectingDB->query($sql);

          $SrNo = 0;

          while ($DataRows = $Execute->fetch()) {
            $CommentId = $DataRows["id"];
            $DateTimeOfComment = $DataRows["datetime"];
            $CommenterName = $DataRows["name"];
            $CommentContent = $DataRows["comment"];
            $CommentPostId = $DataRows["post_id"];
            $SrNo++;

            // shortens the name of the commentor to fit the table cell
            if (strlen($CommenterName) > 10) {
              $CommenterName = substr($CommenterName, 0, 10) . '...';
            }
            // shortens the datetime to fit the table cell
            if (strlen($DateTimeOfComment) > 11) {
              $DateTimeOfComment = substr($DateTimeOfComment, 0, 11) . '...';
            }

          ?>

            <tbody>
              <tr>
                <td><?php echo htmlentities($SrNo++); ?></td>
                <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                <td><?php echo htmlentities($CommenterName); ?></td>
                <td><?php echo htmlentities($CommentContent); ?></td>
                <td style="min-width: 140px" style="min-width: 140px"><a class="btn btn-warning" href="DisApproveComments.php?id=<?php echo $CommentId; ?>">Dis-Approve</a></td>
                <td><a class="btn btn-danger" href="DeleteComments.php?id=<?php echo $CommentId; ?>">Delete</a></td>
                <td style="min-width: 140px" style="min-width: 140px"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?>" target="_blank">Live Preview</a></td>
              </tr>

            </tbody><!-- /tbody  -->
          <?php } ?>
          <!-- end-while loop  -->
        </table><!-- /table  -->
      </div><!-- /col  -->
    </div><!-- /row -->
  </section>
  <!-- /section -->


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