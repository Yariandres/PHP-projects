<?php 
session_start();

if(!isset($_SESSION['email'])) {
  header("Location:signin.php?err_msg=This is an Admin page, please login");
  exit();
}
?>


  <!doctype html>
  <html lang="en">
    <head>
      <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <script>
      tinymce.init({
        selector: 'textarea'
      });
    </script>
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
