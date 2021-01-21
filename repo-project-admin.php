<?php
require 'db.php';
include 'session.php';

//session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
  echo "<script>window.location.assign('index.php')</script>";
}



if (isset($_POST['submit'])) {
  //form details
  $projectName = $_POST['POT'];
  $description = $_POST['description'];
  $projectType = $_POST['TOP'];
  $year = $_POST['year'];
  $department = $_POST['department'];
  $major = $_POST['major'];
  $abstract = $_POST['abstract'];


  if ($_POST['studentId1'] === "") {
    $studentId1 = 'NULL';
  } else {
    $studentId1 = $_POST['studentId1'];
  }


  if ($_POST['studentId2'] === "") {
    $studentId2 = 'NULL';
  } else {
    $studentId2 = $_POST['studentId2'];
  }

  $svID = $_POST['svID'];

  //img upload
  $imgFile = $_FILES['poster']['name'];
  $tmp_dir = $_FILES['poster']['tmp_name'];
  $imgSize = $_FILES['poster']['size'];
  $imgDir = 'img/';
  $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
  $validExt = array('jpeg', 'jpg', 'png');
  $cImg = rand(1000, 1000000) . "." . $imgExt;

  //move img from tmp to dir
  if (in_array($imgExt, $validExt)) {
    move_uploaded_file($tmp_dir, $imgDir . $cImg);
  } else {
    $errorMsg = "<script>alert ('Sorry, please upload JPG, JPEG and PNG files only') </script>";
    echo $errorMsg;
  }

  //pdf files
  $pdfFile = $_FILES['summary']['name'];
  $tmpDirPdf = $_FILES['summary']['tmp_name'];
  $pdfSize = $_FILES['summary']['size'];
  $pdfDir = 'files/';
  $pdfExt = strtolower(pathinfo($pdfFile, PATHINFO_EXTENSION));
  $validPdfExt = array('pdf');
  $cPdf = rand(1000, 1000000) . "." . $pdfExt;

  //move img from tmp to dir
  if (in_array($pdfExt, $validPdfExt)) {
    move_uploaded_file($tmpDirPdf, $pdfDir . $cPdf);
  } else {
    $errorMsg = "<script>alert ('Sorry, please upload PDF files only') </script>";
    echo $errorMsg;
  }




  //tak ada $errorMsg proceed upload ke db
  if (!isset($errorMsg)) {
    $sqlAdd = (mysqli_query($con, "INSERT INTO `project`(`projectID`, `projectName`, `description`, `projectType`, `year`, `department`, `major`, `studentId1`, `studentId2`, `studentId3`, `svID`, `imgDir`, `fileDir`, `abstract`) VALUES (NULL,'$projectName','$description', '$projectType' ,'$year','$department','$major','$studentId1',$studentId2, NULL,'$svID','$cImg','$cPdf' ,'$abstract')"));
    if (!isset($error)) {
      echo "<script>alert ('New record successfully inserted!') </script>";
      if ($department == 'BCS') {
        echo "<script>window.location.assign('manage-project.php?view=<?php $view = 'BCS'')</script>";
      } else {
        echo "<script>window.location.assign('manage-project.php?view=<?php $view = 'BIT'')</script>";
      }
    } else {
      echo "<script>alert ('Error occured while uploading your project') </script>";
    }
  }
}




?>

<!DOCTYPE html>
<html>
<title>Project Submission</title>
<style>
  p {
    text-align: left;
  }

  form {
    margin: auto;
  }
</style>

<body>


  <br>
  <div class="container">
    <div class="w3-center" style="padding:5% 40px" id="contact">

      <h3 class="w3-center">FINAL YEAR PROJECT FINAL REPORT SUBMISSION</h3>
      <div style="margin-top:48px" class="w3-center">


        <form action="" method="POST" enctype="multipart/form-data" class="w3-center" style="width:40%;">


          <p><strong>Name 1 </strong><select class="w3-input w3-border" type="text" name="studentId1" id="studentId1">
              <option value="">Please Select</option>
              <?php
              $srchId1 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'student'");
              while ($row = mysqli_fetch_array($srchId1)) {
              ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php
              }
              ?>
            </select></p>

          <p><strong>Name 2</strong><select class="w3-input w3-border" id="studentId2" name="studentId2">
              <option value="">Please Select</option>
              <?php
              $srchId2 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'student'");
              while ($row = mysqli_fetch_array($srchId2)) {
              ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php
              }
              ?>
            </select><caption> (Leave this blank if do not have partner)</caption></p>

          <!-- <p><strong>Partner Name </strong><select class="w3-input w3-border" id="studentId3" name="studentId3">
              <option value="">Please Select</option>
              <?php
              $srchId3 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'student'");
              while ($row = mysqli_fetch_array($srchId3)) {
              ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php
              }
              ?>
            </select> -->

          <p><strong>Supervisor Name </strong><select class="w3-input w3-border" id="svID" name="svID">
              <option value="NULL">Please Select</option>
              <?php
              $srchSv = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'lecturer'");
              while ($row = mysqli_fetch_array($srchSv)) {
              ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php
              }
              ?>
            </select></p>

          <p><strong>Course</strong><select class="w3-input w3-border" id="department" name="department"> /* sama dgn department kut */
              <option value="BIT">Bachelor in Information Technology (BIT)</option>
              <option value="BCS">Bachelor of Computer Science (BCS)</option>
            </select></p>

          <p><strong>Course Code</strong><select class="w3-input w3-border" id="major" name="major">
              <option value="INFO4993">Final Year Project 1 - Bachelor in Information Technology (BIT)</option>
              <option value="CSC4993">Final Year Project 1 - Bachelor of Computer Science (BCS)</option>
              <option value="INFO4994">Final Year Project 2 - Bachelor in Information Technology (BIT)</option>
              <option value="CSC4994">Final Year Project 2 - Bachelor of Computer Science (BCS)</option>
            </select></p>

          <p><strong>Project Title</strong><input style="text-transform:uppercase" class="w3-input w3-border" type="text" size="50" name="POT" placeholder="Enter Your Project Title"></p>

          <p><strong>Project Type</strong><select class="w3-input w3-border" id="TOP" name="TOP">
              <option value="System Development">System Development</option>
              <option value="Multimedia">Multimedia Project</option>
              <option value="Research">Research</option>
            </select></p>

          <p><strong>Year</strong>
            <select class="w3-input w3-border" id="year" name="year">
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2023">2024</option>
            </select>
          </p>

          <p><strong>Awards</strong><input style="text-transform:uppercase" class="w3-input w3-border" name="abstract" id="abstract" cols="50" rows="10" maxlength="3000"></input></p>
          <p><strong>Introduction</strong><textarea class="w3-input w3-border" name="description" id="description" cols="50" rows="10" maxlength="3000"></textarea></p>


          <p><strong>Project Poster</strong><input class="w3-input w3-border " type="file" size="50" name="poster" id="poster"><caption> (Please upload .jpg only)</caption></p>
          <p><strong>Project Summary</strong><input class="w3-input w3-border" type="file" size="50" name="summary" id="summary"><caption> (Please upload .pdf only)</caption></p>

          </br>
          <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="submit">


        </form>

      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>