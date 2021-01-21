<?php

require 'reg-student-pro.php';

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "fypgallery";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

# student database
  $matricNo = $_POST['mno'];
  $sname = $_POST['sname'];
  $spsw = $_POST['spsw'];
  $spswrpt = $_POST['spswrpt'];
  $sdepartment = $_POST['sdepartment'];
  $semail = $_POST['semail'];

$result = mysql_query("SELECT * FROM student WHERE matricNo = '$matricNo' and spsw = '$spsw'")or die("Failed to query database" . mysql_error());
$row = mysql_fetch_array($result);
  if ($row['matricNo'] == $matricNo && $row['spsw'] == $spsw) {
  header('Location:test.php');
  }

  else {
  header('Location:contact.php');
  }
