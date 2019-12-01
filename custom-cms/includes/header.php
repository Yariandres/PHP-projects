<?php 
  include("includes/config.php");
  include("includes/db.php");
  
  $query = "SELECT * FROM categories";

  $categories = $db->query($query);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Custom CMS · Baby Wearing</title>

  

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <a class="blog-header-logo text-dark" href="#">Main-Logo</a>
          </div>

          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="#"></a>
          </div>

          <div class="col-4 d-flex justify-content-end align-items-center">
            <!-- ICON HERE -->
            <a class="btn btn-sm btn-outline-secondary" href="#">Book an Appointment</a>
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="navbar d-flex justify-content-between">
         
            <?php if(isset($_GET['caterogy'])) { ?>            
              <a class="p-2" href="index.php">Home</a>
            <?php } else {  ?>
              <a class="p-2  active" href="index.php">Home</a>
            <?php } ?>

            <?php if($categories->num_rows > 0) {
            while($row = $categories->fetch_assoc()) {
              if (isset($_GET['category']) && $row['id'] == $_GET['category']) {?>
              <a class="p-2 active" href="index.php?category=<?php echo $row['id'] ?>"><?php echo $row['text']; ?></a>
                <?php } else echo "<a class='p-2' href='index.php?category=$row[id]'>$row[text]</a>";
              } } ?>
          </ul>      
        </nav>
        
      </div>

      


    