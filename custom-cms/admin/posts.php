<?php 
include("includes/header.php");
include("includes/sidebar.php");
?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Posts</h1>        
      </div>
      <a href="new_post.php" class="btn btn-info btn-lg my-4">Add New</a>
      <div class="table-responsive">
        <form method="post">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Select</th>
                <th>Date Posted</th>
                <th>Title</th>
                <th>Author</th>
                <th>Tags</th>
                <th>Category</th>
                <th>Edit</th>
              </tr>
            </thead><!-- /table head-->

            <tbody>
              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>Baby Wraps</td>
                <td>Baby Wraps Category</td>
                <td><a href="#" class="btn btn-warning mr-1">Edit</a></td>           
              </tr>

              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>Baby Wraps</td>
                <td>Baby Wraps Category</td>
                <td><a href="#" class="btn btn-warning mr-1">Edit</a></td>           
              </tr>

              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>Baby Wraps</td>
                <td>Baby Wraps Category</td>
                <td><a href="#" class="btn btn-warning mr-1">Edit</a></td>           
              </tr>                      
            </tbody> <!-- /table body -->
          </table> <!-- /posts table -->

          <div class="input-group">
            <select class="custom-select" name="action" aria-label="Select">
              <option selected>Choose...</option>
              <option value="1">Delete</option>
              <option value="2">Clone</option>            
            </select><!-- /select -->

            <div class="input-group-append">
              <button type="submit" name="apply" class="btn btn-outline-secondary">Apply</button>
            </div>
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
