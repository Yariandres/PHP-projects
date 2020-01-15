<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- checks if logged in or not  -->
<?php Confirm_Login(); ?>
<?php
$Parameter = $_GET["id"];

global $connectingDB;

$sql = "SELECT * FROM posts WHERE id='$Parameter'";
$stmt = $connectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {

  $TitleToBeDeleted     = $DataRows['title'];
  $CategoryToBeDeleted  = $DataRows['category'];
  $ImageToBeDeleted     = $DataRows['image'];
  $PostToBeDeleted      = $DataRows['post'];
}

// submit button if-condition
if (isset($_POST["Submit"])) {

  global $connectingDB;
  $sql = "DELETE FROM posts WHERE id = '$Parameter'";

  // query to delete Post from DB 
  $Execute = $connectingDB->query($sql);

  if ($Execute) {
    $Target_Path_To_DELETE_Image = "Uploads/$ImageToBeDeleted";
    unlink($Target_Path_To_DELETE_Image);
    $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
    Redirect_to("Posts.php");
  } else {
    $_SESSION["ErrorMessage"] = "Something went wrong, please try again!";
    Redirect_to("Posts.php");
  }
} // ending Submit button if-condition
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

  <title>Delete Post</title>
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
          <h1 class="lead"><i class="fa fa-edit"></i>Delete Post</h1>
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

        <form action="DeletePost.php?id=<?php echo $Parameter; ?>" method="post" enctype="multipart/form-data">
          <div class="card mb-3">
            <div class="card-body bg-dark">

              <div class="form-group">
                <label class="text-light" for="title"> Post Title</label>
                <input disabled class="form-control" type="text" name="PostTitle" id="title" value="<?php echo $TitleToBeDeleted; ?>">
              </div>

              <div class="form-group">
                <label class="text-light" for="imageSelect">
                  <p class="FieldInfo">
                    Image:
                    <img class="img-thumbnail" src="Uploads/<?php echo $ImageToBeDeleted; ?>" alt="post image" width="250" height="auto" class="img-thumbnail">
                  </p>
                </label><!-- /label  -->
              </div><!-- /form-group  -->


              <div class="form-group">
                <label for="Post"><span class="text-light">Post :</span></label>
                <textarea disabled class="form-control m-0 p-0" id="Post" name="PostDescription">
                <?php echo $PostToBeDeleted; ?>
                </textarea>
              </div><!-- /form-group  -->

              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i> to dashboard</a>
                </div>

                <div class="col-lg-6">
                  <button type="submit" name="Submit" class="btn btn-danger btn-block">
                    <i class="fa fa-trash"></i> Delete
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