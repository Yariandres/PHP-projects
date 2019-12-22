<?php
include("includes/config.php");
include("includes/db.php");

include("includes/header.php");
include("includes/sidebar.php");

if(isset($_GET['category'])) {
  $id = mysqli_real_escape_string($db , $_GET['category']);
  $query = "SELECT * FROM categories WHERE id = '$id'";
  $c = $db->query($query);
  $c = $c->fetch_assoc();
}

if(isset($_POST['add_category'])) {
  $category = mysqli_real_escape_string($db , $_POST['category']);

  if(isset($_GET['category'])) {
    $query = "UPDATE categories SET text = '$category' WHERE id = '$id'";
    $db->query($query);

  } else {
    $query = "INSERT INTO categories (text) VALUE('$category')";
    $db->query($query);
  }

  
}

?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Add New Category</h1>        
      </div>
     
      <div class="table-responsive">
        <form method="post">

            <div class="form-group">
              <label for="category">Category : </label>

              <input type="text" class="form-control" name="category" id="category" value="<?php echo @$c['text']; ?>">
            </div><!-- /form group -->       

          <div class="input-group">            
            <button type="submit" name="add_category" class="btn btn-outline-secondary">Add Category</button>          
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
