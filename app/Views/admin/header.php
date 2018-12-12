<?php session_start(); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Project 3</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
  </head>

  <body>
    <?php

    include("inc/course_day.php");
    include("inc/course.php");
    include("inc/course_ex.php");
    include("inc/user.php");

    ?>
    <nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow">
      <?php 
      echo "<p class='m-3 text-white'>Welcome " .$_SESSION['name']. " !</p>";
      ?>
      <input class="form-control form-control-dark w-50 m-2" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../login/a_logout.php?logout">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-lg-2 col-md-2 col-sm-12 d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column pt-2">
              <li class="nav-item">
                <a class="nav-link" href="admin.php">
                  <span data-feather="home"></span>
                  Home<span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#modal_course">
                  <span data-feather="plus-circle"></span>
                  Add Course
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#modal_user">
                  <span data-feather="plus-circle"></span>
                  Add User
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#modal_course_day">
                  <span data-feather="plus-circle"></span>
                  Add Day
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#modal_course_exercise">
                  <span data-feather="plus-circle"></span>
                  Add Exercise
                </a>
              </li>
            </ul>
          </div>
        </nav>