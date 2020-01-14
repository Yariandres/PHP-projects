<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php $SearchQueryPerameter = $_GET["id"]; ?>

<?php

if (isset($_POST["Submit"])) {
  $Name     = $_POST["CommenterName"];
  $Email    = $_POST["CommenterEmail"];
  $Comment  = $_POST["CommenterThoughts"];
  $CurrentTime = time();
  $DateTime = strftime("%d  %B - %Y - %H:%M:%S", $CurrentTime);

  if (empty($Name) || empty($Email) || empty($Comment)) {
    $_SESSION["ErrorMessage"] = "All fields must be filled out";
    Redirect_to("FullPost.php?id={$SearchQueryPerameter}");
  } elseif (strlen($Comment) > 500) {
    $_SESSION["ErrorMessage"] = "Comment length should be less than 500 charecters";
    Redirect_to("FullPost.php?id={$SearchQueryPerameter}");
  } else {

    // query to insert comment in the DB when everything is fine

    $sql  = "INSERT INTO comments(datetime, name, email, comment, approvedby, status, post_id)";

    $sql .= "VALUES(:dateTime, :name, :email, :comment, 'pending', 'OFF', :postIdFromURL)";

    $stmt = $connectingDB->prepare($sql);
    // binding comment values
    $stmt->bindValue(':dateTime', $DateTime);
    $stmt->bindValue(':name', $Name);
    $stmt->bindValue(':email', $Email);
    $stmt->bindValue(':comment', $Comment);
    $stmt->bindValue(':postIdFromURL', $SearchQueryPerameter);

    $Execute = $stmt->execute();

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Comment Submited Successfully";
      Redirect_to("FullPost.php?id={$SearchQueryPerameter}");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong, please try again!";
      Redirect_to("FullPost.php?id={$SearchQueryPerameter}");
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

  <title>Blog Page</title>
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
            <a href="Blog.php" class="nav-link">Home</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">About us</a>
          </li>

          <li class="nav-item">
            <a href="Blog.php" class="nav-link">Blog</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">Contact us</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">Features</a>
          </li>
        </ul><!-- /ul  -->

        <ul class="navbar-nav ml-auto">
          <form class="form-inline d-none d-sm-block" action="Blog.php">
            <input class="form-control mr-2" type="text" name="Search" placeholder="Search">
            <button class="btn btn-primary" name="SearchButton">Go</button>


          </form>
        </ul><!-- /ul  -->

      </div><!-- /collapse  -->
    </div><!-- /container  -->
  </nav>
  <!-- /NAVBAR -->

  <!-- <div class="container">
    <div class="jumbotron">
      <h1 class="display-4">Baby Wearing Blog</h1>
    </div>
  </div> -->



  <!-- MAIN  -->
  <div class="container mb-5">
    <div class="row">
      <div class="col-sm-8">

        <?php
        global $connectingDB;

        // SQL query when search button is active
        if (isset($_GET["SearchButton"])) {
          $Search = $_GET["Search"];

          // matching search query 
          $sql = "SELECT * FROM posts WHERE datetime LIKE :search OR title LIKE :search OR category LIKE :search OR post LIKE :search";

          $stmt = $connectingDB->prepare($sql);
          $stmt->bindValue(':search', '%' . $Search . '%');
          $stmt->execute();
        } else {

          $PostIdFromURL = $_GET["id"];

          if (!isset($PostIdFromURL)) {
            $_SESSION["ErrorMessage"] = "Bad request";
            Redirect_to("Blog.php");
          }

          $sql = "SELECT * FROM posts WHERE id='$PostIdFromURL' ";
          $stmt = $connectingDB->query($sql);
        }

        // the default SQL query        
        while ($DataRows = $stmt->fetch()) {
          $PostId          = $DataRows["id"];
          $DateTime        = $DataRows["datetime"];
          $PostTitle       = $DataRows["title"];
          $Category        = $DataRows["category"];
          $Admin           = $DataRows["author"];
          $Image           = $DataRows["image"];
          $PostDescription = $DataRows["post"];

        ?>

          <div class="card">
            <div class="card-body">

              <img class="card-img-top img-fluid" src="Uploads/<?php echo htmlentities($Image); ?>" alt="Post image">

              <h4 class="card-title mt-3">
                <?php echo htmlentities($PostTitle); ?>
              </h4>

              <small class="blockquote-footer">Written by: <?php echo htmlentities($Admin); ?> On <?php echo htmlentities($DateTime); ?></small>

              <span class="badge badge-light float-right">Comments 20</span>
              <hr>
              <?php
              echo '<p class\'lead\'>' . htmlentities($PostDescription) . '</p>';
              ?>
            </div><!-- /card-body  -->
          </div><!-- /card  -->
        <?php } ?>

        <h3 class="pb-4 my-5 font-italic border-bottom">
          Comments:
        </h3>
        <!-- COMMENT-->

        <!-- fetching comments from DB  -->
        <?php
        global $connectingDB;
        $sql = "SELECT * FROM comments WHERE post_id='$SearchQueryPerameter'";
        $stmt = $connectingDB->query($sql);

        while ($DataRows = $stmt->fetch()) {
          $CommentDate = $DataRows['datetime'];
          $CommenterName = $DataRows['name'];
          $CommentContent = $DataRows['comment'];
        ?>

          <!-- dispalys the whole post -->
          <div class="media">
            <div class="media-body">
              <!-- dispalys name -->
              <h6 class="lead mt-0"><?php echo $CommenterName; ?></h6>

              <!-- displays date -->
              <small class="blockquote-footer">
                <?php echo $CommentDate; ?>
              </small>

              <!-- displays comment  -->
              <p class="lead">
                <?php echo $CommentContent; ?>
              </p>
            </div>
          </div>
        <?php } ?>
        <!-- end-of comments while loop -->


        <!-- /COMMENT-->

        <!-- COMMNET FORM  -->
        <hr>
        <!-- form ALERT MESSAGES -->
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>

        <form action="FullPost.php?id=<?php echo $SearchQueryPerameter; ?>" method="post">
          <h5 class="font-italic">Share your thoughs about this post?</h5>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="CommenterName" class="form-control" id="name">
          </div><!-- /form-group -->

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="CommenterEmail" class="form-control" id="email">
          </div><!-- /form-group -->

          <div class="form-group">
            <label for="textarea">Comment</label>
            <textarea name="CommenterThoughts" class="form-control" id="textarea" rows="3">
            </textarea>
          </div><!-- /form-group -->

          <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
        </form><!-- /form  -->
      </div><!-- /col -->
      <!-- /COMMNET FORM  -->


      <!-- SIDEBAR  -->
      <div class="col-sm-4">
        <p class="display-4">SIDE BAR</p>
      </div><!-- /col  -->
      <!-- /SIDEBAR  -->

    </div> <!-- /row  -->


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