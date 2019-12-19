<?php 
include("includes/header.php");
include("includes/sidebar.php");
?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Comments</h1>        
      </div>
     
      <div class="table-responsive">
        <form method="post">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Select</th>
                <th>Author</th>
                <th>Website</th>
                <th>Post</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Reply</th>
                <th>Comment</th>
              </tr>
            </thead><!-- /table head-->

            <tbody>
              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>Yari</td>
                <td>yariherrera.com</td>
                <td>Sample Baby Wrap Post</td>
                <td>Nice informative post...</td>
                <td><button class="btn btn-success">Approved</button></td>
                <td><a href="#" class="btn btn-info mr-1">Reply</a></td>
                <td>
                  <textarea class="form-control" id="exampleFormControlTextarea1"></textarea>
                </td>           
              </tr>

              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>Nikola</td>
                <td>nikola.com</td>
                <td>Sample Event Post</td>
                <td>Awesome informative post...</td>
                <td><button class="btn btn-success">Approved</button></td>
                <td><a href="#" class="btn btn-info mr-1">Reply</a></td>
                <td>
                  <textarea class="form-control" id="exampleFormControlTextarea1"></textarea>
                </td>           
              </tr>

              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>Viktoria</td>
                <td>viktoria.com</td>
                <td>Sample Baby Wraps Post</td>
                <td>Wow informative post...</td>
                <td><button class="btn btn-warning">Pending</button></td>
                <td><a href="#" class="btn btn-info mr-1">Reply</a></td>
                <td>
                  <textarea class="form-control" id="exampleFormControlTextarea1"></textarea>
                </td>           
              </tr>

              <tr>
                <td><input type="checkbox" name="checkbox[]"></td>
                <td>Maria</td>
                <td>maria.com</td>
                <td>Sample Wraps Post</td>
                <td>Wow informative post...</td>
                <td><button class="btn btn-success">Approved</button></td>
                <td><a href="#" class="btn btn-info mr-1">Reply</a></td>
                <td>
                  <textarea class="form-control" id="exampleFormControlTextarea1"></textarea>
                </td>           
              </tr>
                     
            </tbody> <!-- /table body -->
          </table> <!-- /posts table -->

          <div class="input-group">
            <select class="custom-select" name="action" aria-label="Select">
              <option selected>Choose...</option>
              <option value="1">Delete</option>
              <option value="2">Approve</option>            
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
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="dashboard.js"></script></body>
</html>
