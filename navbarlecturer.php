<?php
require 'db.php';

?>


<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Raleway", sans-serif
    }

    body,
    html {
        height: 100%;
        line-height: 1.8;
    }

    .w3-bar .w3-button {
        padding: 16px;
    }


    /* Full height image header */
    .bgimg-1 {
        background-position: center;
        background-size: cover;
        background-image: url("https://www.iium.edu.my/media/20489/IMG_6454.jpg");
        min-height: 80%;
    }


    table {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid grey;
    margin-left: auto;
    margin-right: auto;

  }

  th,
  td {
    text-align: left;
    padding: 6px;
  }

  th {
    background-color: #ffffff;
    color: black;
    border-bottom: double;

  }

  tr:nth-child(even) {
    background-color: #f1f1f1;
  }

    form {
        margin: auto;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


</style>
</body>
<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-teal" id="myNavbar">
        <a href="homepage.php" class="w3-bar-item w3-button w3-wide">KICT 'Arshif</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="landing-lect.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> DASHBOARD</a>
            <a href="user-profile.php" class="w3-bar-item w3-button"><i class="fa fa-user-circle-o"></i> PROFILE</a>  
            <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LOG OUT</a>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="landing-lect.php" class="w3-bar-item w3-button"><i class="fa fa-th"></i>EVALUATE PROJECT</a>
            <a href="user-profile.php" class="w3-bar-item w3-button"><i class="fa fa-th"></i>PROFILE</a>            
            <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> LOG OUT</a>
</nav>