<?php
require 'db.php';
include 'session.php';
//session_start();

if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
  echo "<script>window.location.assign('index.php')</script>";
}

if (isset($_SESSION['mysesi'])) {
  $sessionId = $_SESSION['mysesi'];
}

if (isset($_POST['Submit'])) {
  // code bawah ni dia nk ambil value dari form lepas tu dia tambah
  $rmark1 = $_POST['rm'];
  $gEvaluation = $_GET['projectID'];


  // Code ni nk cek mana satu evaluator, dia evaluator 1 ke 2 ke 3 ke seklali dgn comment
  $getList = "SELECT * FROM `evaluation` INNER JOIN project on evaluation.projectID = project.projectID WHERE (`evaluatorID1` = '$sessionId' || `evaluatorID2` = '$sessionId' || `evaluatorID3` = '$sessionId') AND evaluation = $gEvaluation";
  $resultList = $con->query($getList);
  if ($resultList->num_rows > 0) {
    while ($row = $resultList->fetch_assoc()) {
      $eva1 = $row['evaluatorID1'];
      $eva2 = $row['evaluatorID2'];
      $eva3 = $row['evaluatorID3'];
      $evaID = $row['evaluation'];
    }
  }




  if ($eva1 == $sessionId) {
    $sqlAdd = (mysqli_query($con, "UPDATE `evaluation` SET `reportMark2` = '$rmark1' WHERE `evaluation`.`evaluation` = '$gEvaluation'"));
    if (!isset($error)) {
      echo "<script>alert ('New record successfully inserted!') </script>";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo "<script>alert ('Error occured while uploading your project') </script>";
    }
  } elseif ($eva2 == $sessionId) {
    $sqlAdd = (mysqli_query($con, "UPDATE `evaluation` SET `reportMark2` = '$rmark1' WHERE `evaluation`.`evaluation` = '$gEvaluation'"));
    if (!isset($error)) {
      echo "<script>alert ('New record successfully inserted!') </script>";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo "<script>alert ('Error occured while uploading your project') </script>";
    }
  } elseif ($eva3 == $sessionId) {
    $sqlAdd = (mysqli_query($con, "UPDATE `evaluation` SET `reportMark3` = '$rmark1' WHERE `evaluation`.`evaluation` = '$gEvaluation'"));
    if (!isset($error)) {
      echo "<script>alert ('New record successfully inserted!') </script>";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo "<script>alert ('Error occured while uploading your project') </script>";
    }
  }
}

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit Mark </title>
</head>

<body>
  <div class="container">
    <div class="w3-center" style="padding:5% 40px" id="contact">

      <h3 class="w3-center">Submit mark for the report</h3>
      <div style="margin:108px" class="w3-center">


        <form action="" method="POST" class="w3-center" style="width:20%;">
          <p><strong>Enter Mark </strong>
            <input type="text" id="rm" name="rm" class="w3-input w3-border">

            </br>


            <button class="w3-button w3-black w3-center" type="sumbit" id="Submit" name="Submit"> Submit </button>

      </div>
    </div>

</body>
<?php include 'footer.php'; ?>

</html>