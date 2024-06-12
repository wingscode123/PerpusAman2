<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/datepicker.css" rel="stylesheet">
  <link href="../assets/css/custom.css" rel="stylesheet">
  <style type="text/css" media="screen">
    .modal-wide .modal-dialog {
      width: 40%;
    }
    .dropdown-menu {
      z-index: 2000 !important;
    }
  </style>
  <title>Perpustakaan Universitas Brawijaya</title>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="clearfix"></div>
          <div class="profile">
            <div class="profile_pic">
              <img src="../assets/images/default.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome </span>
              <h2>
              <?php    
                  $is_admin = isset($_SESSION['admin']);
                  $is_manajer = isset($_SESSION['manajer']);             
                  $welcomeMessage = "Guest"; // Default welcome message for guests
                  
                  if ($is_admin) {
                    $welcomeMessage = "Admin";
                  } elseif ($is_manajer) {
                    $welcomeMessage = "Manager";
                  }
                  echo $welcomeMessage; // Display the welcome message
                ?>
              </h2>
            </div>
          </div>

          <br />
