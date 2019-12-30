    <aside class="col-md-4 blog-sidebar">
      <!-- search post field -->
      <div class="p-4">
        <h4>Search</h4>
        <form method="GET" action="results.php" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">Name</label>
          <input type="text" name="search" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search...">
        </form>
      </div>

      <div class="p-4 mb-3 bg-light rounded">
        <h4>About</h4>
        <p class="mb-0"><?php echo $about_text; ?></p>
      </div>

      <?php if (isset($_POST['subscribe'])) {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);

        $query = "INSERT INTO subscribers (name,email) VALUES('$name','$email')";
        $db->query($query);
      } ?>
      <!-- subscribe form -->
      <div class="p-4">
        <h4>Subscribe</h4>
        <form method="POST">
          <div class="form-group">
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name...">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group">
            <input type="email" name="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Email...">
          </div>
          <button type="submit" name="subscribe" class="btn btn-outline-success">Subscribe</button>
        </form>
      </div><!-- /subscribe form -->
      <hr>

      <div class="p-4">
        <h4>Categories</h4>
        <?php $q = "SELECT * FROM categories";
        $categories = $db->query($q);
        ?>
        <ul class="list-unstyled mb-0">
          <?php while ($c = $categories->fetch_assoc()) { ?>
            <li><a href="index.php?category=<?php echo $c['id']; ?>"><?php echo $c['text']; ?></a></li>
          <?php } ?>
        </ul>
      </div>

      <!-- <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div> -->
    </aside><!-- /.blog-sidebar -->
    <!-- /.blog-sidebar -->