<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php ?>

<?php
$Parameter = $_GET["id"];

if (isset($_POST["Submit"])) {
  $PostTitle = $_POST["PostTitle"];
  $Category = $_POST["Category"];
  // to grab the image file 
  $Image = $_FILES["Image"]["name"];
  // saves image to Upload/folder
  $Target = "Uploads/" . basename($_FILES["Image"]["name"]);
  $PostText = $_POST["PostDescription"];
  $Admin = "Yari";
  $CurrentTime = time();
  $DateTime = strftime("%d  %B - %Y - %H:%M:%S", $CurrentTime);

  if (empty($PostTitle)) {
    $_SESSION["ErrorMessage"] = "Title cant be empty";
    Redirect_to("Posts.php");
  } elseif (strlen($PostTitle) < 5) {
    $_SESSION["ErrorMessage"] = "Post title should be greater than 5 charecters";
    Redirect_to("Posts.php");
  } else if (strlen($PostText) > 999) {
    $_SESSION["ErrorMessage"] = "Post description should be less than 1000 charecters";
    Redirect_to("Posts.php");
  } else {

    global $connectingDB;

    // if image is not empty then update image    
    if (!empty($_FILES['Image']['name'])) {
      $sql = "UPDATE posts SET 
                title    ='$PostTitle', 
                category = '$Category', 
                image    = '$Image', 
                post     = '$PostText' 
                WHERE id = '$Parameter' ";
    } else {

      // otherwise do not update image 
      $sql = "UPDATE posts SET 
                title    ='$PostTitle', 
                category = '$Category', 
                post     = '$PostText' 
                WHERE id = '$Parameter' ";
    }



    $Execute = $connectingDB->query($sql);

    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Post with id : " . $connectingDB->lastInsertId() . " Post updated Successfully";
      Redirect_to("Posts.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong, please try again!";
      Redirect_to("Posts.php");
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

  <title>Edit Post</title>
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
          <h1 class="lead"><i class="fa fa-edit"></i> Edit Post</h1>
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

        global $connectingDB;

        $sql = "SELECT * FROM posts WHERE id='$Parameter'";
        $stmt = $connectingDB->query($sql);
        while ($DataRows = $stmt->fetch()) {

          $TitleToBeUpdated = $DataRows['title'];
          $CategoryToBeUpdated = $DataRows['category'];
          $ImageToBeUpdated = $DataRows['image'];
          $PostToBeUpdated = $DataRows['post'];
        }
        ?>

        <form action="EditPost.php?id=<?php echo $Parameter; ?>" method="post" enctype="multipart/form-data">
          <div class="card mb-3">
            <div class="card-body bg-dark">

              <div class="form-group">
                <label class="text-light" for="title"> Post Title</label>
                <input class="form-control" type="text" name="PostTitle" id="title" value="<?php echo $TitleToBeUpdated; ?>">
              </div>

              <div class="form-group">

                <label class="text-light" for="CategoryTitle">
                  <p class="FieldInfo">
                    Current Category:
                    <span class="text-danger">
                      <?php echo $CategoryToBeUpdated; ?>
                    </span>
                  </p>
                </label><!-- /label  -->

                <br>
                <label class="text-light" for="CategoryTitle">
                  <span class="FieldInfo">Chose Category</span>
                </label>

                <select class="form-control-sm" id="CategoryTitle" name="Category">
                  <?php

                  // fetching all the categories from category table
                  global $connectingDB;
                  $sql = "SELECT id, title FROM category";
                  $stmt = $connectingDB->query($sql);

                  while ($DataRows = $stmt->fetch()) {
                    $Id = $DataRows["id"];
                    $CategoryName = $DataRows["title"];

                  ?>
                    <option><?php echo $CategoryName; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">

                <label class="text-light" for="imageSelect">
                  <p class="FieldInfo">
                    Current Image:
                    <img class="img-thumbnail" src="Uploads/<?php echo $ImageToBeUpdated; ?>" alt="post image" width="250" height="auto" class="img-thumbnail">
                  </p>
                </label><!-- /label  -->


                <div class="custom-file">
                  <input type="file" name="Image" id="imageSelect" class="form-control-sm text-light custom-file-input">
                  <label for="imageSelect" class="custom-file-label">Select image</label>
                </div>
              </div>

              <div class="form-group">
                <label for="Post"><span class="text-light">Post :</span></label>
                <textarea class="form-control m-0 p-0" id="Post" name="PostDescription">
                <?php echo $PostToBeUpdated; ?>
                </textarea>
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