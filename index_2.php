<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-image:url('10.jpg');background-repeat:no-repeat;background-size: cover;">
    <?php  include 'header.php';  include 'connection.php'; ?>
     <div class="container-fluid">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2" style="margin-left: -30px;">
        <?php   include 'asidenav.php'; ?> </div>
      <div class="col-md-10">
  <h4 class="my-2">Admin Dashboard</h4>
  <div class="col-md-12 my-1">
    <div class="row">
      <div class="col-md-3 bg-success mx-1" style="height: 130px;">
      <div class="col-md-4">
      <a href="aadmin.php"></a>
    </div>
      <div class="col-md-12">
  <div class="row">
    <div class="col-md-8">
      <?php
$ad =mysqli_query($connect, "SELECT * FROM admin");
      $num = mysqli_num_rows($ad);
      ?>
      <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num; ?></h5>
      <h5 class="text-white">Total</h5>
      <h5 class="text-white">Admin</h5>
    </div>
    

    
    </div>
  </div>
</div>
<div class="col-md-3 bg-info mx-1" style="height: 130px;">
<div class="col-md-12">
  <div class="row">
    <div class="col-md-8">
    <?php

$ad =mysqli_query($connect, "SELECT * FROM doctor");

$num = mysqli_num_rows($ad);


?>
    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num; ?></h5>
      <h5 class="text-white">Total</h5>
      <h5 class="text-white">Doctors</h5>
    </div>

    
    </div>
  </div>
</div>



<div class="col-md-3 bg-warning mx-1" style="height: 130px;">
<div class="col-md-12">
  <div class="row">
    <div class="col-md-8">
    <?php

$ad =mysqli_query($connect, "SELECT * FROM patient");

$num = mysqli_num_rows($ad);


?>
    <h5 class="my-2 text-white" style="font-size: 30px;"><?php echo $num; ?></h5>
      <h5 class="text-white">Total</h5>
      <h5 class="text-white">Patient</h5>
    </div>

    
    </div>
  </div>
</div>
</div>


      