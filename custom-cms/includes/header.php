<?php ob_start(); ?>
<?php
$query = "SELECT * FROM categories";

$categories = $db->query($query);
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link rel="icon" href="../../favicon.ico"> -->

  <title><?php echo $page_title ?></title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- animate css  -->
  <link rel="stylesheet" href="css/animate.css">


  <!-- Custom styles for this template -->
  <link href="css/blog.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a href="index.php">
            <img src="img/logo.png" width="auto" height="60" class="navbar-brand">
          </a>
        </div>

        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="btn btn-outline-success" href="#">Book an Appointment</a>
        </div>
      </div>
    </header>
  </div><!-- /container  -->

  <div class="container">
    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">

        <?php if (isset($_GET['caterogy']) || strpos($_SERVER['REQUEST_URI'], "index.php") === false) { ?>
          <a class="p-2" href="index.php">Home</a>
        <?php } else { ?>
          <a class="p-2  active" href="index.php">Home</a>
        <?php } ?>

        <?php if ($categories->num_rows > 0) {
          while ($row = $categories->fetch_assoc()) {
            if (isset($_GET['category']) && $row['id'] == $_GET['category']) { ?>
              <a class="p-2 active" href="index.php?category=<?php echo $row['id'] ?>"><?php echo $row['text']; ?></a>
        <?php } else echo "<a class='p-2' href='index.php?category=$row[id]'>$row[text]</a>";
          }
        } ?>
      </nav>
    </div>
  </div> <!-- /container  -->


  <div class="container-fluid">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <!-- <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol> -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/slider-img-1.jpg" class="d-block w-100" alt="SzamoTulimy image">
          <div class="carousel-caption d-none d-md-block">
            <h1 class="text-left animated bounce">Szamotulimy Events</h1>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slider-img-2.jpg" class="d-block w-100" alt="SzamoTulimy image">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="text-left bounceInUp">Szamotulimy Workshop</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/slider-img-3.jpg" class="d-block w-100" alt="SzamoTulimy image">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="text-left fadeInDownBig">Szamotulimy Speakers Experts</h2>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div><!-- /container-fluid  -->

  <div class="container">
    <div class="row">
      <div class="col-sm-8 blog-main">