<?php 
include("includes/config.php");
include("includes/db.php");
include("includes/header.php");
include("includes/sidebar.php");

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
  $entity = mysqli_real_escape_string($db , $_GET['entity']);
  $action = mysqli_real_escape_string($db , $_GET['action']);
  $id = mysqli_real_escape_string($db , $_GET['id']);

  if($action == "delete") {

    if($entity == "post") {
      $query = "DELETE FROM posts WHERE id = '$id'";
    } else if ($entity == "comment") {
      $query = "DELETE FROM comments WHERE id = '$id'";
    } else {
      $query = "DELETE FROM categories WHERE id = '$id'";
      $q = "UPDATE posts SET category='0' WHERE category='$id'";
    }

  } else {
    $query = "UPDATE comments set status = '1' WHERE id='$id'";    
  }

  $db->query($query);
  if(isset($q)) {
    $db->query($q);
  }
}

// GET ALL POSTS FROM DB
$query = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db->query($query);

// GET ALL COMMENTS FROM DB
$query = "SELECT * FROM comments WHERE status='0' ORDER BY id DESC";
$comments = $db->query($query);

// GET ALL CATEGORIES FROM DB
$query = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db->query($query);
?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>        
      </div>


      <h2>Recent Posts</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Date Posted</th>
              <th>Title</th>
              <th>Author</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = $posts->fetch_assoc()) {?>
            <tr>
              <td><?php echo $row['date']; ?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['author']; ?></td>
              <td>
                <a href="new_post.php?post=<?php echo $row['id']; ?>" class="btn btn-warning mr-1">Edit</a>
                <a href="index.php?entity=post&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>           
            </tr>
            <?php }?> 

          </tbody>
        </table><!-- /posts table -->

        <!-- COMENTS TABLE -->
        <h2>Recent Comments (pending)</h2>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Comment</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php while($row = $comments->fetch_assoc()) {?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td>
                  <a href="index.php?entity=comment&action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success mr-1">Approve</a>
                  <a href="index.php?entity=comment&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>           
              </tr>           
            <?php }?> 

          </tbody>
        </table><!-- /comments table -->

        <!-- CATEGORY TABLE -->
        <h2>Recent Categories</h2>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php while($row = $categories->fetch_assoc()) {?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['text']; ?></td>
                <td>
                  <a href="new_category.php?category=<?php echo $row['id']; ?>" class="btn btn-warning mr-1">Edit</a>

                  <a href="index.php?entity=category&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>           
              </tr>
            <?php }?> 
                   
          </tbody>
        </table><!-- /categories table -->
      </div>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script></body>
</html>
