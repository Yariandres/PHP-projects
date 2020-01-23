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
  <nav class="navbar navbar-expand-lg navbar-light py-2">
    <div class="container">
      <a href="Blog.php?page=1" class="navbar-brand">Baby Wearing Blog</a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav m-auto">

          <li class="nav-item">
            <a href="Blog.php?page=1" class="nav-link">Home</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">About</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">Events</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">Contact us</a>
          </li>

        </ul><!-- /ul  -->

        <ul class="navbar-nav ml-auto">
          <a class="btn btn-outline-info text-info" name="SearchButton">Book An Appointment</a>
        </ul><!-- /ul  -->
      </div><!-- /collapse  -->
    </div><!-- /container  -->
  </nav>
  <!-- /NAVBAR -->


  <hr>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="Images/slider-img-1.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="display-4">Second slide label</h5>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="Images/slider-img-2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="display-4">Second slide label</h5>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="Images/slider-img-3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="display-4">Second slide label</h5>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- displays alert messages -->
  <?php
  echo ErrorMessage();
  echo SuccessMessage();
  ?>

  <!-- HEADER  -->
  <div class="container my-5">
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
            $ShowPostFrom = ($Page * 5) - 4;
          }

          // get from the DB
          $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
          $stmt = $connectingDB->query($sql);
        } elseif (isset($_GET["category"])) {
          $Category = $_GET["category"];

          // using PDO name parameter 
          $sql = "SELECT * FROM posts WHERE category=:categoryName ORDER BY id desc";
          $stmt = $connectingDB->prepare($sql);
          $stmt->bindValue(':categoryName', $Category);
          $stmt->execute();
        } else {
          $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
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


          <div class="post-container">
            <img class="col-auto float-left" src="Uploads/<?php echo htmlentities($Image); ?>" alt="Post image" height="100">

            <a href="FullPost.php?id=<?php echo $PostId; ?>">
              <h4 class="card-title my-3 lead">
                <?php echo htmlentities($PostTitle); ?>
              </h4>
            </a>

            <small class="text-muted">Category: <a href="Blog.php?category=<?php echo $Category ?>"><?php echo $Category ?></a> & </small>
            <small class="text-muted">Written by: <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"><?php echo htmlentities($Admin); ?></a> On <?php echo htmlentities($DateTime); ?></small>

            <span class="badge btn-outline-info float-right">Comments <?php echo ApprovedComments($PostId); ?></span>

            <?php
            if (strlen($PostDescription < 250)) {
              $PostDescription = substr($PostDescription, 0, 250) . '...';
            }
            echo '<p class\'lead\'>' . htmlentities($PostDescription) . '</p>';
            ?>

            <div class="col-auto text-right">
              <a href="FullPost.php?id=<?php echo $PostId; ?>">
                <span class="btn btn-outline-info text-dark">Read More</span>
              </a>
            </div>
            <hr>
          </div><!-- /post-container  -->
        <?php } ?>

        <hr>
        <!-- PAGINATION  -->

        <nav aria-label="Page navigation">
          <ul class="pagination">
            <!-- creating backward button  -->
            <?php
            if (isset($Page)) {
              if ($Page > 1) { ?>
                <li class="page-item">
                  <a class="page-link" href="Blog.php?page=<?php echo $Page - 1; ?>">&laquo;</a>
                </li>
            <?php }
            } ?>

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
            for ($i = 1; $i < $PostPagination; $i++) {
              if (isset($Page)) {
                if ($i == $Page) { ?>
                  <li class="page-item active">
                    <a href="Blog.php?page=<?php echo $i; ?>" class="page-link">
                      <?php echo $i; ?>
                    </a>
                  </li>
                <?php
                } else { ?>
                  <li class="page-item">
                    <a href="Blog.php?page=<?php echo $i; ?>" class="page-link">
                      <?php echo $i; ?>
                    </a>
                  </li>
            <?php } // end of else
              } // end of if-condition
            } ?>
            <!-- // end of for-loop -->

            <!-- creating forward button  -->
            <?php
            // if page is set and no page number given 
            if (isset($Page) && !empty($Page)) {
              if ($Page + 1 <= $PostPagination) { ?>
                <li class="page-item">
                  <a class="page-link" href="Blog.php?page=<?php echo $Page + 1; ?>">&raquo;</a>
                </li>
            <?php }
            } ?>
          </ul>
        </nav>
      </div><!-- /col -->
      <!-- /PAGINATION   -->

      <!-- SIDEAREA -->
      <aside class="col-md-4 blog-sidebar bg-light rounded">
        <!-- CATEGORIES -->
        <div class="p-4">
          <h4 class="lead">Categories</h4>
          <ol class="list-unstyled mb-0">
            <?php
            // connects to DB
            global $connectingDB;

            // feching from DB
            $sql = "SELECT * FROM category ORDER BY id desc";

            $stmt = $connectingDB->query($sql);

            while ($DataRows = $stmt->fetch()) {
              $CategoryId = $DataRows["id"];
              $CategoryName = $DataRows["title"];
            ?>
              <!-- creates a list -->
              <nav class="navbar-light">
                <li class="nav-item">
                  <a href="Blog.php?category=<?php echo $CategoryName; ?>" style="color: rgba(0, 0, 0, 0.5);">
                    <?php echo $CategoryName ?>
                  </a>
                </li>
              </nav>
            <?php } ?>
          </ol>
        </div>
        <!-- /CATEGORIES  -->

        <hr>
        <!-- Search content  -->
        <ul class="navbar-nav my-5">
          <h4 class="lead">Search Posts</h4>
          <form class="form-inline d-none d-sm-block" action="Blog.php">
            <input class="form-control mr-2" type="text" name="Search" placeholder="Search">
            <button class="btn btn-outline-primary" name="SearchButton">Go</button>
          </form>
        </ul><!-- /ul  -->

        <hr>
        <!-- RECENT POSTS -->
        <div class="p-4">
          <h4 class="lead">Popular Posts</h4>
          <ol class="list-unstyled">
            <?php
            // connects to DB

            global $connectingDB;

            // feching from DB
            $sql = "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";

            $stmt = $connectingDB->query($sql);

            while ($DataRows = $stmt->fetch()) {
              $Id = $DataRows["id"];
              $Title = $DataRows["title"];
              $DateTime = $DataRows["datetime"];
              $Image = $DataRows["image"];
            ?>
              <li>
                <img src="Uploads/<?php echo htmlentities($Image); ?>" class="col-auto d-none d-lg-block" height="70" alt="image post">
                <a href="FullPost.php?id=<?php echo htmlentities($Id) ?>" target="_blank">
                  <h6 class="lead mt-3"><?php echo htmlentities($Title); ?></h6>
                </a>
                <small class="text-muted"><?php echo htmlentities($DateTime); ?></small>
              </li>
              <hr>
            <?php } ?>
            <!-- /while loop  -->
          </ol>
        </div>
        <!-- /RECENT POSTS -->

        <hr>
        <!-- subscribe form -->
        <div class="my-5">
          <h4 class="lead">Subscribe</h4>
          <form method="POST">
            <div class="form-group">
              <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name...">
            </div>

            <div class="form-group">
              <input type="email" name="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Email...">
            </div>
            <button type="submit" name="subscribe" class="btn btn-outline-primary">Subscribe</button>
            <small id="emailHelp" class="form-text text-muted mt-4">We'll never share your email with anyone else.</small>
          </form>
        </div><!-- /subscribe form -->
      </aside><!-- /.blog-sidebar -->
      <!-- /SIDEAREA  -->

    </div> <!-- /row  -->
  </div><!-- /container  -->
  <!-- /HEADER  -->

  <?php require("Includes/Footer.php"); ?>