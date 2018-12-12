<?php session_start(); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Project 3</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../../css/style.css">
  </head>

  <body>
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow">
      <?php 
      echo "<p class='m-3 text-white'>Welcome " .$_SESSION['name']. " !</p>";
      ?>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../login/a_logout.php?logout">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-g-2 col-md-2 col-sm-12 d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column pt-2">
              <li class="nav-item">
                <a class="nav-link" href="trainer.php">
                  <span data-feather="users"></span>
                  Pair room<span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="history.php">
                  <span data-feather="calendar"></span>
                  History
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Material
                </a>
              </li>
            </ul>
          </div>
        </nav>