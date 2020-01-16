<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

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
      <a href="Blog.php" class="navbar-brand">Baby Wearing Blog</a>

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

  <div class="container">
    <div class="jumbotron">
      <h1 class="display-4">Baby Wearing Blog</h1>
    </div>
  </div>

  <!-- displays alert messages -->
  <?php
  echo ErrorMessage();
  echo SuccessMessage();
  ?>

  <!-- HEADER  -->
  <div class="container mb-5">
    <div class="row">
      <div class="col-sm-8">

        <?php
        global $connectingDB;

        // SQL query when search button is active
        if (isset($_GET["SearchButton"])) {
          $Search = $_GET["Search"];

          // matching search query 
          $sql = "SELECT * FROM posts 
          WHERE datetime LIKE :search 
          OR title LIKE :search 
          OR category 
          LIKE :search 
          OR post 
          LIKE :search";

          $stmt = $connectingDB->prepare($sql);
          $stmt->bindValue(':search', '%' . $Search . '%');
          $stmt->execute();
        } elseif (isset($_GET["page"])) { // Pagination is Active
          $Page = $_GET["page"];

          // if page is equal to zero or one, show index page 1
          if ($Page == 0 || $Page < 1) {
            $ShowPostFrom = 0;
          } else {
            $ShowPostFrom = ($Page * 4) - 4;
          }

          // get from the DB
          $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,4";


          $stmt = $connectingDB->query($sql);
        } else {
          $sql = "SELECT * FROM posts ORDER BY id desc";
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
              <h4 class="card-title mt-3">
                <?php echo htmlentities($PostTitle); ?>
              </h4>

              <img class="card-img-top img-thumbnail" src="Uploads/<?php echo htmlentities($Image); ?>" alt="Post image" height="100">

              <small class="text-muted">Category: <?php echo $Category ?> & </small>
              <small class="text-muted">Written by: <?php echo htmlentities($Admin); ?> On <?php echo htmlentities($DateTime); ?></small>

              <span class="badge btn-outline-info float-right">Comments <?php echo ApprovedComments($PostId); ?></span>

              <hr>

              <?php
              if (strlen($PostDescription < 150)) {
                $PostDescription = substr($PostDescription, 0, 150) . '...';
              }
              echo '<p class\'lead\'>' . htmlentities($PostDescription) . '</p>';
              ?>

              <a href="FullPost.php?id=<?php echo $PostId; ?>" class="float-right">
                <span class="btn btn-outline-info text-dark">Read More</span>
              </a>

            </div><!-- /card-body  -->
          </div><!-- /card  -->
        <?php } ?>

        <hr>
        <!-- PAGINATION  -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
            <?php
            // connects to the DB
            global $connectingDB;

            //counts posts
            $sql = "SELECT COUNT(*) FROM posts";

            // use DB connection and call the method of query
            $stmt = $connectingDB->query($sql);

            $RowPagination = $stmt->fetch();

            // Array to string conversion
            $TotalPosts = array_shift($RowPagination);

            // devides total amount of posts by 4 
            $PostPagination = $TotalPosts / 4;

            // ceil function to round the number and show 4 post per page
            $PostPagination = ceil($PostPagination);


            // itarate through post pagination 
            for ($i = 1; $i <= $PostPagination; $i++) {

            ?>
              <li class="page-item">
                <a class="page-link" href="Blog.php?page=<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              </li>

            <?php } ?>
          </ul>
        </nav>
      </div><!-- /col -->

      <div class="col-sm-4">
        <p class="display-4">Hello world</p>
      </div><!-- /col  -->

    </div> <!-- /row  -->
  </div><!-- /container  -->
  <!-- /HEADER  -->


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