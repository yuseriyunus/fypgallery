<?php

require 'db.php';
session_start();

# student database
$matricNo = $_POST['mno'];
$sname = $_POST['sname'];
$spsw = $_POST['spsw'];
$spswrpt = $_POST['spswrpt'];
$sdepartment = $_POST['sdepartment'];
$semail = $_POST['semail'];
$phone = $_POST['phone'];

if ($spsw == $spswrpt) {
  $sql = "INSERT INTO user (id, name, password, type, department, email, phone) VALUES ('$matricNo', '$sname', '$spsw','student' ,'$sdepartment', '$semail','$phone');";
  mysqli_query($con, $sql);
  echo "<script>alert ('Account created successfully! Please Log in.') </script>";
  if ($_SESSION['mytype'] == 'admin') {
    echo "<script>window.location.assign('user.php?view=student')</script>";
  }
  echo "<script>window.location.assign('login.php')</script>";
} else {
  echo "<script>alert ('Password insert are not same. Try again.') </script>";
  echo "<script>window.location.assign('reg-student-pro.php')</script>";
}