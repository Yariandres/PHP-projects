<?php include("includes/header.php");
  if (isset($_GET['post'])){
    $id = mysqli_real_escape_string($db , $_GET['post']);
    $query = "SELECT * FROM posts WHERE id='$id'";
  }

  $posts = $db->query($query);

  if (isset($_POST['post_comment'])) {
    $name = mysqli_real_escape_string($db , $_POST['name']);
    $comment = mysqli_real_escape_string($db , $_POST['comment']);

    if(isset($_POST['website'])) {
      $website = mysqli_real_escape_string($db , $_POST['website']);
    } else {
      $website = "";
    }

    $query = "INSERT INTO comments (name, comment, post, website) VALUES('$name', '$comment', '$id', '$website')";

    if ($db->query($query)) {
      echo "<script>alert('comment inserted!')</script>";
    } else {
      echo "<script>alert('comment not inserted.')</script>";
    }
  }

?>
        <br>
        <?php if($posts->num_rows > 0) { while($row = $posts->fetch_assoc()) {?>          

          <div class="blog-post">
            <h2 class="blog-post-title">
              <?php echo $row['title']; ?>
            </h2>

            <p class="blog-post-meta"><?php echo $row['date']; ?> 
              By 
              <a href="#"><?php echo $row['author']; ?></a>
            </p>          

            <?php echo $row['body']; ?>
    
          </div><!-- /.blog-post -->

          <?php } } ?>
        <hr>

        <blockquote>2 comments</blockquote>

        <!-- FORM -->
        <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Website</label>
            <input type="text" name="website" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Write your comment</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <button type="submit" name="post_comment" class="btn btn-primary">Post Comment</button>
        </form> <!-- /FORM -->
        

        <div class="comment mt-5">
        <div class="comment-head">
        <img width="50" height="50" class="rounded" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse4.mm.bing.net%2Fth%3Fid%3DOIP.ug1hsAagPO-if-D9l5yNBgHaHa%26pid%3DApi&f=1" alt="Image of monica">          
        <a href="#">Monica S</a>          

        <h5 class="mt-4">Coment by Monica</h5>

        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
        <p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>        
        </div>
      </div> 

      <div class="comment mt-5">
        <div class="comment-head">
        <img width="50" height="50" class="rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2IaTJGPJYUd9cZ86kcJDTOeq_5y6_sZsdJM_27sC_Mgg4vEuviA&s" alt="Image of Natalia">
        <a href="#">Natalia S</a>
        <button class="btn btn-info btn-xs ml-4">Admin</button>     

        <h5 class="mt-4">Coment by Natalia</h5>

        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
        </div>
      </div>

      </div><!-- /.blog-main -->

      <!-- SIDE BAR -->     
      <?php include("includes/sidebar.php"); ?>           

      <!-- Footer  -->    
      <?php include("includes/footer.php");?>

