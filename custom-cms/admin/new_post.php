<?php 
// CONNECT TO DB 
include("includes/config.php");
include("includes/db.php");

include("includes/header.php");
include("includes/sidebar.php");

if (isset($_POST['add_post'])) {
  $title = mysqli_real_escape_string($db , $_POST['title']);
  $author = mysqli_real_escape_string($db , $_POST['author']);
  $category = mysqli_real_escape_string($db , $_POST['category']);
  $body = mysqli_real_escape_string($db , $_POST['body']);
  $keywords = mysqli_real_escape_string($db , $_POST['keywords']);

  $d = getDate();
  $date = "$d[month], $d[mday], $d[year]";

  $query = "INSERT INTO posts (title,author,category,body,keywords,date) VALUES('$title','$author','$category ','$body','$keywords','$date')";

  $db->query($query);
}

// getting categories and assing it to cats variable 
$cats = $db->query("SELECT * FROM categories");

?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Add New Post</h1>        
      </div>
     
      <div class="table-responsive">
        <form method="post">

            <div class="form-group">
              <label>Post Title : </label>
              <input type="text" class="form-control" name="title">
            </div><!-- /form group --> 

            <div class="form-group">
              <label>Post Author : </label>
              <input type="text" class="form-control" name="author">
            </div><!-- /form group -->  
            
            <div class="form-group">
              <label>Post Category : </label>
              <select class="custom-select" name="category">
                
              <!-- fetching categories from db  -->
                <?php while($row = $cats->fetch_assoc()) {?>
                  <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['text']; ?>
                  </option>                
                <?php }?>

              </select><!-- /select group --> 
            </div><!-- /form group --> 

            <div class="form-group">
              <label>Post Body : </label>
              <textarea name="body" class="form-control"></textarea>
            </div><!-- /form group -->
            
            <div class="form-group">
              <label>Post Keywords : </label>
              <input type="text" class="form-control" name="keywords">
            </div><!-- /form group --> 

          <div class="input-group">            
            <button type="submit" name="add_post" class="btn btn-outline-secondary">Add Post</button>          
          </div><!-- /input group -->
          
        </form><!-- /form -->
      </div><!-- /table div -->
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
