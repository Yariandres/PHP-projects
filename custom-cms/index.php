<?php include("includes/header.php");
  if (isset($_GET['category'])){
    $category = mysqli_real_escape_string($db , $_GET['category']);
    $query = "SELECT * FROM posts WHERE category='$category'";
  } else {
    $query = "SELECT * FROM posts";
  }  

  $posts = $db->query($query);
  ?>   
          <div class="blog-header">
           <h1 class="blog-title">Baby Wearing Posts</h1>
           <p class="lead blog-description">The official baby wearing blog!</p>
          </div>

          <?php if($posts->num_rows > 0) { 
            while($row = $posts->fetch_assoc()) { 
          ?>
          

          <div class="blog-post">
            <h2 class="blog-post-title">
              <a href="single.php?post=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a>
            </h2>

            <p class="blog-post-meta"><?php echo $row['date']; ?> 
              By 
              <a href="#"><?php echo $row['author']; ?></a>
            </p>          

            <?php $body = $row['body']; 
              echo substr($body, 0, 300) . "...";
            ?>
            
            <a href="single.php?post=<?php echo $row['id'] ?>" class="btn btn-primary">Continue reading</a>
          </div><!-- /.blog-post -->

          <?php } }?>

        </div><!-- /.blog-main -->

        <!-- SIDE BAR -->     
        <?php include("includes/sidebar.php");?>           

    <!-- Footer  -->    
    <?php include("includes/footer.php");?> 
  </body>
</html>
