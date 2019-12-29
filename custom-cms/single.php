<?php
include("includes/config.php");
include("includes/db.php");

if (isset($_GET['post'])) {
  $post = mysqli_real_escape_string($db, $_GET['post']);
  $p = $db->query("SELECT * FROM posts WHERE id='$post'");
  $p1 = $p->fetch_assoc();

  $page_title = $p1['title'];
}

include("includes/header.php");

if (isset($_GET['post'])) {
  $id = mysqli_real_escape_string($db, $_GET['post']);
  $query = "SELECT * FROM posts WHERE id='$id'";
}

$posts = $db->query($query);

if (isset($_POST['post_comment'])) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $comment = mysqli_real_escape_string($db, $_POST['comment']);

  if (isset($_POST['website'])) {
    $website = mysqli_real_escape_string($db, $_POST['website']);
  } else {
    $website = "";
  }
  $query = "INSERT INTO comments (name,comment,post,website) VALUES('$name','$comment','$id','$website')";
  $db->query($query);
  header("Location:single.php?post=$id");
  exit();
}

$query = "SELECT * FROM comments WHERE post='$id' AND status='1'";
$comments = $db->query($query);

?>
<br>
<?php if ($posts->num_rows > 0) {
  while ($row = $posts->fetch_assoc()) { ?>

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

<?php }
} ?>
<hr>

<blockquote><?php echo $comments->num_rows ?> comments</blockquote>

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
  <button type="submit" name="post_comment" class="btn btn-outline-success">Post Comment</button>
</form> <!-- /FORM -->



<?php while ($comment = $comments->fetch_assoc()) {

  if ($comment['is_admin'] != 1) {
?>

    <div class="comment mt-5">
      <div class="comment-head">

        <img width="50" height="50" src="http://lorempixel.com/400/200" alt="user image">
        <a href="#"><?php echo $comment['name']; ?></a>
      </div>
      <p><?php echo $comment['comment']; ?></p>
    </div>

  <?php } else { ?>

    <div class="comment mt-5">
      <div class="comment-head">

        <a href="http://lorempixel.com/400/200" class="btn btn-info btn-xs">Admin</a>
        <a href="#"><?php echo $comment['name']; ?></a>
      </div>
      <p><?php echo $comment['comment']; ?></p>
    </div>

<?php }
} ?>

</div><!-- /.blog-main -->

<!-- SIDE BAR -->
<?php include("includes/sidebar.php"); ?>

<!-- Footer  -->
<?php include("includes/footer.php"); ?>