<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- checks if logged in or not  -->
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
?>

<?php
// get the existing admin
$AdminId = $_SESSION["User_ID"];

// connects to db
global $connectingDB;

// get admin by the current user session 
$sql = "SELECT * FROM admins WHERE id='$AdminId'";

// using database connection
$stmt = $connectingDB->query($sql);

// gets and shows data 
while ($DataRows = $stmt->fetch()) {
  $ExistingName = $DataRows["aname"];
}

if (isset($_POST["Submit"])) {
  $PostTitle = $_POST["PostTitle"];
  $Category = $_POST["Category"];
  // to grab the image file 
  $Image = $_FILES["Image"]["name"];
  // saves image to Upload/folder
  $Target = "Uploads/" . basename($_FILES["Image"]["name"]);
  $PostText = $_POST["PostDescription"];
  $Admin = $_SESSION["UserName"];
  $CurrentTime = time();
  $DateTime = strftime("%d  %B - %Y - %H:%M:%S", $CurrentTime);

  if (empty($PostTitle)) {
    $_SESSION["ErrorMessage"] = "Title cant be empty";
    Redirect_to("AddNewPost.php");
  } elseif (strlen($PostTitle) < 5) {
    $_SESSION["ErrorMessage"] = "Post title should be greater than 5 charecters";
    Redirect_to("AddNewPost.php");
  } else if (strlen($PostText) > 9999) {
    $_SESSION["ErrorMessage"] = "Post description should be less than 10000 charecters";
    Redirect_to("AddNewPost.php");
  } else {

    global $connectingDB;

    // query to insert Post in the DB when everything is fine
    $sql = "INSERT INTO posts(datetime, title, category, author, image,post)";
    $sql .= "VALUES(:dateTime, :postTitle, :categoryName, :adminName, :imageName, :postDescription)";

    $stmt = $connectingDB->prepare($sql);
    $stmt->bindValue(':dateTime', $DateTime);
    $stmt->bindValue(':postTitle', $PostTitle);
    $stmt->bindValue(':categoryName', $Category);
    $stmt->bindValue(':adminName', $Admin);
    $stmt->bindValue(':imageName', $Image);
    $stmt->bindValue(':postDescription', $PostText);
    $Execute = $stmt->execute();
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Post with id : " . $connectingDB->lastInsertId() . " Added Successfully";
      Redirect_to("AddNewPost.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong, please try again!";
      Redirect_to("AddNewPost.php");
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

  <title>Admin Profile</title>
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
          <li class="nav-item"><a href="Logout.php" class="nav-link"><i class="fa fa-user-times text-danger"></i>
              Logout</a></li>
        </ul><!-- /ul  -->

      </div><!-- /collapse  -->
    </div><!-- /container  -->
  </nav>
  <!-- /NAVBAR -->

  <!-- HEADER  -->
  <header class="my-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="lead"><i class="fa fa-user"></i> Edit Profile</h1>
        </div>
      </div> <!-- /row  -->
    </div><!-- /container  -->
  </header>
  <!-- /HEADER  -->

  <!-- MAIN  -->
  <div class="section container py-2 mb-4">
    <div class="row">
      <!-- LEFT AREA  -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <h3 class="lead"><?php echo $ExistingName; ?></h3>
          </div><!-- /card-header  -->

          <div class="card-body">
            <img src="img/avatar.JPG" class="block img-fluid" alt="">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore repudiandae facilis </p>
          </div>
        </div>
      </div>
      <!-- LEFT AREA  -->

      <!-- RIGHT AREA  -->
      <div class="col-md-9">
        <!-- displays messages  -->
        <?php

        echo ErrorMessage();
        echo SuccessMessage();
        ?>

        <form action="MyProfile.php" method="post" enctype="multipart/form-data">
          <div class="card mb-3">

            <div class="card-header">
              <h4 class="lead">Edit Profile</h4>
            </div>

            <div class="card-body bg-dark">

              <div class="form-group">

                <input class="form-control" type="text" name="Name" id="profileName" placeholder="Your Name">
              </div>

              <div class="form-group">
                <input class="form-control" type="text" name="Headline" id="title" placeholder="Headline">
                <small class="text-light">Add a profession</small>
                <span class="text-danger">no more than 12 characters</span>
              </div>

              <div class="form-group">
                <label for="Bio"><span class="FieldInfo text-light">Bio :</span></label>
                <textarea class="form-control" id="Post" name="Bio"></textarea>
              </div>

              <div class="form-group">
                <div class="custom-file">
                  <input type="file" name="Image" id="imageSelect" class="form-control-sm text-light custom-file-input">
                  <label for="imageSelect" class="custom-file-label">Select image</label>
                </div>
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