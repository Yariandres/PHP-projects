
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Dashboard Template · Bootstrap</title>    

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
  



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Baby Wearing</a>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>

    </nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

          <li class="nav-item">
            <a class="nav-link active" href="index.php">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="posts.php">
              <span data-feather="file"></span>
              Posts
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="comments.php">
              <span data-feather="file"></span>
              Comments
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="categories.php">
              <span data-feather="file"></span>
              Categories
            </a>
          </li>
        </ul> <!-- /nav ul  -->        
      </div><!-- /sidebar-sticky  -->      
    </nav> <!-- /nav  -->
    

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td><a href="#" class="btn btn-warning mr-1">Edit</a><a href="#" class="btn btn-danger">Delete</a></td>
           
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td><a href="#" class="btn btn-warning mr-1">Edit</a><a href="#" class="btn btn-danger">Delete</a></td>
            
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td><a href="#" class="btn btn-warning mr-1">Edit</a><a href="#" class="btn btn-danger">Delete</a></td>
              
            </tr>           
          </tbody>
        </table>

        <!-- COMENTS TABLE -->
        <h2>Recent Comments</h2>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Comment</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td><a href="#" class="btn btn-success mr-1">Approve</a><a href="#" class="btn btn-danger">Delete</a></td>
           
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td><a href="#" class="btn btn-success mr-1">Approve</a><a href="#" class="btn btn-danger">Delete</a></td>
            
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td><a href="#" class="btn btn-success mr-1">Approve</a><a href="#" class="btn btn-danger">Delete</a></td>
              
            </tr>           
          </tbody>
        </table>

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
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td><a href="#" class="btn btn-success mr-1">Approve</a><a href="#" class="btn btn-danger">Delete</a></td>
           
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td><a href="#" class="btn btn-success mr-1">Approve</a><a href="#" class="btn btn-danger">Delete</a></td>
            
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td><a href="#" class="btn btn-success mr-1">Approve</a><a href="#" class="btn btn-danger">Delete</a></td>              
            </tr>           
          </tbody>
        </table>
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
