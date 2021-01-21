<?php
require 'db.php';
include "session.php";


if (isset($_GET['projectID'])) {
  $gProjectID = $_GET['projectID'];
  $srch = mysqli_query($con, "SELECT * FROM `project` WHERE projectID = $gProjectID");
  if ($srch->num_rows > 0) {
    while ($row = $srch->fetch_assoc()) {
      $projectName = $row['projectName'];
      $description = $row['description'];
      $projectType = $row['projectType'];
      $year = $row['year'];
      $department = $row['department'];
      $major = $row['major'];
      $studentId1 = $row['studentId1'];
      $studentId2 = $row['studentId2'];
      $studentId3 = $row['studentId3'];
      $svID = $row['svID'];
      $imgDir = $row['imgDir'];
      $abstract = $row['abstract'];
      $file = $row['fileDir'];
    }
  }

  if (!is_null($studentId1)) {
    $srchStudent1 = mysqli_query($con, "SELECT * FROM `user` WHERE id = $studentId1");
    if ($srchStudent1->num_rows > 0) {
      while ($row = $srchStudent1->fetch_assoc()) {
        $nameStudent1 = $row['name'];
        $departmentStudent1 = $row['department'];
        $emailStudent1 = $row['email'];
        $phoneStudent1 = $row['phone'];
      }
    }
  }

  if (!is_null($studentId2)) {
    $srchStudent2 = mysqli_query($con, "SELECT * FROM `user` WHERE id = $studentId2");
    if ($srchStudent2->num_rows > 0) {
      while ($row = $srchStudent2->fetch_assoc()) {
        $nameStudent2 = $row['name'];
        $departmentStudent2 = $row['department'];
        $emailStudent2 = $row['email'];
        $phoneStudent2 = $row['phone'];
      }
    }
  } else {
    $nameStudent2 = null;
    $departmentStudent2 = null;
    $emailStudent2 = null;
    $phoneStudent2 = null;
  }

  if (!is_null($studentId3)) {
    $srchStudent3 = mysqli_query($con, "SELECT * FROM `user` WHERE id = $studentId3");
    if ($srchStudent3->num_rows > 0) {
      while ($row = $srchStudent3->fetch_assoc()) {
        $nameStudent3 = $row['name'];
        $departmentStudent3 = $row['department'];
        $emailStudent3 = $row['email'];
        $phoneStudent3 = $row['phone'];
      }
    }
  } else {
    $nameStudent3 = null;
    $departmentStudent3 = null;
    $emailStudent3 = null;
    $phoneStudent3 = null;
  }

  if (!is_null($svID)) {
    $srchSvID = mysqli_query($con, "SELECT * FROM `user` WHERE id = $svID");
    if ($srchSvID->num_rows > 0) {
      while ($row = $srchSvID->fetch_assoc()) {
        $nameSv = $row['name'];
        $departmentSv = $row['department'];
        $emailSv = $row['email'];
        $phoneSv = $row['phone'];
      }
    }
  }
}

?>
<!DOCTYPE html>
<html>
<title><?php echo $projectName ?></title>

<style>
  body,
  html {
    height: 100%;
    line-height: 1.8;
    text-align: justify;
  }
</style>

<body>

  <div class="w3-container" style="padding:50px 40px" id="about">
    &nbsp
    <h1 class="w3-center"><?php echo $projectName ?></h1>
    &nbsp
    <div class="w3-container ">
      <img src="img/<?php echo $imgDir; ?>" style="width:40% ; background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  border: 5px solid #ddd;">

      <div class="w3-col l7 m6 w3-margin-bottom w3-left">
        <div class="w3-container">
          <Strong>Project Details</Strong>

          <strong>
            <p class="w3-opacity"><?php echo $nameStudent1;
                                  if (!is_null($nameStudent2)) {
                                    echo ", " . $nameStudent2;
                                  }
                                  if (!is_null($nameStudent3)) {
                                    echo ", " . $nameStudent3;
                                  } ?></p>
          </strong>
          <p><?php echo $projectType ?></p>
          <p><?php echo $nameSv ?></p>

          <Strong>Contact</Strong>
          <p><i class="fa fa-map-marker fa-fw w3-large w3-margin-center"></i> Department : <?php echo $department ?></p>
          <p><i class="fa fa-envelope fa-fw w3-larger w3-margin-center"> </i> Student Email : <?php echo $emailStudent1 ?></p>
          <p><i class="fa fa-envelope fa-fw w3-larger w3-margin-center"> </i> Supervisor Email : <?php echo $emailSv ?></p>

          <strong> Awards</strong>
          <p><i class="fa fa-trophy fa-fw w3-larger w3-margin-center"> </i><?php echo $abstract ?></p>

          <h4><strong> Introduction</strong></h4>
          <p><?php echo $description ?></p>


          <a href="downloadfile.php?file=<?php echo $file; ?>" class="w3-button w3-light-grey"><i class="fa fa-download w3-margin-right"></i>Download Project Summary</a>
          <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $emailStudent1; ?>&su='Project Consultation'&body=" target="_blank" class="w3-button w3-light-grey" ><i class="fa fa-phone-square w3-margin-right"></i>Contact Creator</a>
        </div>
      </div>
    </div>

  </div>
</body>
<?php include 'footer.php'; ?>

</html>