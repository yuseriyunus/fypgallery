<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "fypgallery";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

# lecturer database
  $staffID = $_POST['staffID'];
  $lename = $_POST['lename'];
  $lepsw = $_POST['lepsw'];
  $lepswrpt = $_POST['lepswrpt'];
  $ledepartment = $_POST['ledepartment'];
  $leemail = $_POST['leemail'];

  if ($lepsw == $lepswrpt) {

  $sql = "INSERT INTO lecturer (staffID, lename, lepsw, lepswrpt, ledepartment, leemail) VALUES ('$staffID', '$lename', '$lepsw', '$lepswrpt', '$ledepartment', '$leemail');";

  mysqli_query($conn, $sql);
  header('Location:test.php');
  }

  else {
  header('Location:reg-lect.php');
  }
