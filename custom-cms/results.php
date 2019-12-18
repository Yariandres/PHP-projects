<?php 
include("includes/config.php");
include("includes/db.php");

if(isset($_GET['search'])) {
  $page_title = "Search results for \"". $_GET['search'] . "\"";  

}

include("includes/header.php");

  if (isset($_GET['search'])){
    $keyword = mysqli_real_escape_string($db , $_GET['search']);
    $query = "SELECT * FROM posts WHERE keywords LIKE '%$keyword%'";
    $posts = $db->query($query);
  } else {
   echo "<p>No Keyword!</p>";
  }    
?>

          <br>
          <blockquote>Search Results for <?php echo @$_GET['search']; ?></blockquote>
          
          <?php if($posts->num_rows > 0) { 
            while($row = $posts->fetch_assoc()) { 
          ?>
          

          <div class="blog-post mt-5">
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
        <?php include("includes/sidebar.php"); ?>           

    <!-- Footer  -->    
    <?php include("includes/footer.php");?> 
  </body>
</html>
