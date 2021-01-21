<?php
require 'db.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
  echo "<script>window.location.assign('login-student.php')</script>";
} else {
  $sessionId = $_SESSION['mysesi'];
}
include "navbarlecturer.php";


if (isset($_GET['evaluation'])) {
  $gEvaluation = $_GET['evaluation'];

  $getID = mysqli_query($con, "SELECT * FROM `evaluation` where evaluation = $gEvaluation");
  if ($getID->num_rows > 0) {
    while ($row = $getID->fetch_assoc()) {
      $gProjectID = $row['projectID'];
    }
  }

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

  //ambil comment dari db
  $getComment = mysqli_query($con, "SELECT * FROM `evaluation` WHERE projectID = $gProjectID");
  if ($getComment->num_rows > 0) {
    while ($row = $getComment->fetch_assoc()) {
      $commentDb = $row['comment'];
    }
  }
}

if (isset($_POST['Submit'])) {
  // code bawah ni dia nk ambil value dari form lepas tu dia tambah
  $a = $_POST['A'];
  $b = $_POST['B'];
  $c = $_POST['C'];
  $d = $_POST['D'];
  $e = $_POST['E'];
  $f = $_POST['F'];
  $g = $_POST['G'];
  $h = $_POST['H'];
  $i = $_POST['I'];
  $j = $_POST['J'];

  $comment = $_POST['comment'];
  $sComment =  $comment . "\n" . $commentDb;

  $totalmark = $a + $b + $c + $d + $e + $f + $g + $h + $i + $j;

  // Code ni nk cek mana satu evaluator, dia evaluator 1 ke 2 ke 3 ke seklali dgn comment
  $getList = "SELECT * FROM `evaluation` INNER JOIN project on evaluation.projectID = project.projectID WHERE (`evaluatorID1` = '$sessionId' || `evaluatorID2` = '$sessionId' || `evaluatorID3` = '$sessionId') AND evaluation = $gEvaluation";
  $resultList = $con->query($getList);
  if ($resultList->num_rows > 0) {
    while ($row = $resultList->fetch_assoc()) {
      $eva1 = $row['evaluatorID1'];
      $eva2 = $row['evaluatorID2'];
      $eva3 = $row['evaluatorID3'];
      $evaID = $row['evaluation'];
      $mark1 = $row['mark1'];
      $mark2 = $row['mark2'];
      $mark3 = $row['mark3'];
      $commentDbT = $row['comment'];
    }
  }




  if ($eva1 == $sessionId) {
    $sqlAdd = (mysqli_query($con, "UPDATE `evaluation` SET `mark1` = '$totalmark', `comment` = '$sComment' WHERE `evaluation`.`evaluation` = '$evaID'"));
    if (!isset($error)) {
      echo "<script>alert ('Your mark is uploaded!') </script>";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo "<script>alert ('Error occured while uploading your mark') </script>";
    }
  } elseif ($eva2 == $sessionId) {
    $sqlAdd = (mysqli_query($con, "UPDATE `evaluation` SET `mark2` = '$totalmark', `comment` = '$sComment' WHERE `evaluation`.`evaluation` = '$evaID'"));
    if (!isset($error)) {
      echo "<script>alert ('Your mark is uploaded!') </script>";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo "<script>alert ('Error occured while uploading your mark') </script>";
    }
  } elseif ($eva3 == $sessionId) {
    $sqlAdd = (mysqli_query($con, "UPDATE `evaluation` SET `mark3` = '$totalmark', `comment` = '$sComment' WHERE `evaluation`.`evaluation` = '$evaID'"));
    if (!isset($error)) {
      echo "<script>alert ('Your mark is uploaded!!') </script>";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo "<script>alert ('Error occured while uploading your mark') </script>";
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

  th,
  td {
    padding: 10px;
    text-align: left;
    border: solid 1px;
  }


  th {
    background-color: white;
    color: black;
  }

  form {
    width: 90%;
  }

</style>

<body>

  <div class="w3-container" style="padding:70px 40px" id="about">
    &nbsp
    <h1 class="w3-center"><?php echo $projectName ?></h1>
    &nbsp
    <div class="w3-container ">
      <img src="img/<?php echo $imgDir; ?>" style="width:40% ; background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  border: 5px solid #ddd;">

      <div class="w3-col l7 m6 w3-margin-bottom w3-left">
        <div class="w3-container">
          <h4><Strong>Project Details</Strong></h4>

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


          <h4><strong> Introduction</strong></h4>
          <p><?php echo $description ?></p>

          <h4><strong> Abstract</strong></h4>
          <p><?php echo $abstract ?></p>
          <a href="downloadfile.php?file=<?php echo $file; ?>" class="w3-button w3-light-grey"><i class="fa fa-download w3-margin-right"></i>Download Project Summary</a>

        </div>
      </div>
    </div>

    <!--NI UNTUK FYP1 - SYSTEM DEVELOPMENT-------- Grab INFO4993, BIT, SD -->
    <?php
    if ($major == 'INFO4993' && $department == 'BIT' && $projectType == 'System Development') { ?>
<h2>Instruction</h2>
      <h5> Please fill the form below based on the : <br>    1 - Unsatisfactory , 2 - Satisfactory, 3 - Good, 4 - Excellent. </h5> </br>
      <form action="" method="post" style="overflow-x:auto">
        <div class="tg-wrap">
          <table class="tg">

            <thead>
              <tr>
                <th class="tg-fymr" colspan="7">
                  <h5><b>Part A : PROJECT PROTOTYPE ASSESSMENT</b></h5>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td class="tg-fymr"><b>Criteria</b></td>
                <td class="tg-fymr"><b>Details</b></td>
                <td class="tg-0pky">(1)</td>
                <td class="tg-0pky">(2)</td>
                <td class="tg-0pky">(3)</td>
                <td class="tg-0pky">(4)</td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Prototype Design Creation</b></td>
                <td class="tg-0pky">Prototype design was presented in high fidelity (hi-fi) and transformed into digital format.The design included all of the proposed elements or components in the project summary.</td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>User Interface</b></td>
                <td class="tg-0pky">Visual elements were carefully created to portray the real product. The interface indicates a well-thought planning for the prototype design.</td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>User Experience</b></td>
                <td class="tg-0pky">All of the prototype design elements were easy to use and adhered to human computer interaction principle.</td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Navigation and Flow</b></td>
                <td class="tg-ucjv">All of the navigation elements were carefully designed and easy to follow.</td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Work Delegation</b></td>
                <td class="tg-0pky">Project development was distributed to a large extent, equally between group members. For individual project, the completed project indicates independent work.</td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="4"></td>
              </tr>
              <tr>
                <td class="tg-fymr" colspan="7">
                  <h5><b>Part B : PROJECT PRESENTATION ASSESSMENT</b></h5>
                </td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Presentation</b></td>
                <td class="tg-0pky">Presenters were all very confident in delivery and they did an excellent job of engaging the examiner. Preparation is the evident.</td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Questions and Answers</b></td>
                <td class="tg-0pky">Presenters understood the project problem and solution. Answers to questions were strengthened by rationalization and explanation.</td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="4"></td>
              </tr>
            </tbody>
          </table>
        </div>


        <h5><strong>Part C : EVALUATOR COMMENTS</strong></h5>
        <p><strong>Fill the Comments Below</strong>
          <textarea class="w3-input w3-border" name="comment" id="comment" cols="5"></textarea></p>

        <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Submit">

      </form>
    <?php } ?>



    <!--NI UNTUK FYP2 - SYSTEM DEVELOPMENT-- -->
    <?php
    if ($major == 'INFO4994' && $department == 'BIT' && $projectType == 'System Development') { ?>
</br>
<h2>Instruction</h2>
      <h5> Please fill the form below based on the : <br>    1 - Unsatisfactory , 2 - Satisfactory, 3 - Good, 4 - Excellent. </h5> </br>
      <form action="" method="post" style="overflow-x:auto">
        <div class="tg-wrap">
          <table class="tg">

            <thead>
              <tr>
                <th class="tg-fymr" colspan="7">
                  <h5><b>Part A : PROJECT DEMO ASSESSMENT</b></h5>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="tg-fymr"><b>Criteria</b></td>
                <td class="tg-fymr"><b>Details</b></td>
                <td class="tg-0pky"> (1)</td>
                <td class="tg-0pky"> (2)</td>
                <td class="tg-0pky"> (3)</td>
                <td class="tg-0pky"> (4)</td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Model (Data)</b></td>
                <td class="tg-0pky">Used of <b>Create, Read, Update</b> and <b>Delete (CRUD)</b> persistence storage in the project. No errors displayed during CRUD operations.</td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>View (Interface)</b></td>
                <td class="tg-ucjv">Visual elements were carefully developed. Navigation buttons, links and logical paths were intuitively designed to find information.</td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Controller (Functions)</b></td>
                <td class="tg-0pky">All functions and proposed features were working correctly without any error.</td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Originality</b></td>
                <td class="tg-0pky">Completed project is innovative, unusual, and novel. Project features and functionalities show inventiveness.</td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Work Delegation</b></td>
                <td class="tg-0pky">Project development was distributed to a large extent, equally between group members. <br>For individual project, the completed project indicates independent work.</td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="4"></td>
              </tr>
              <tr>
                <td class="tg-fymr" colspan="7">
                  <h5><b>Part B : PROJECT PRESENTATION ASSESSMENT</b></h5>
                </td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Presentation</b></td>
                <td class="tg-0pky">Presenters were all very confident in delivery and they did an excellent job of engaging the examiner. Preparation is the evident.</td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Questions and Answers</b></td>
                <td class="tg-0pky">Presenters understood the project problem and solution. Answers to questions were strengthened by rationalization and explanation.</td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="4"></td>
              </tr>


              <tr>
                <td class="tg-fymr" colspan="7">
                  <h5><b>Part C : PROJECT COMPLEXITY ASSESSMENT</b></h5>
                </td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Functionalities and features</b></td>
                <td class="tg-0pky">Functions and features that require complex programming processes, also include complicated individual/project parts and
                                    features to be completed without error. It meets all the defined functionalities and features.</td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Automation of process</b></td>
                <td class="tg-0pky">Successfully automate the manual processes with expected execution and output without any error.</td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>No of developers’ vs functionalities</b></td>
                <td class="tg-0pky">Ratio of functionalities versus developers.</td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="4"></td>
              </tr>



              
            </tbody>
          </table>
        </div>


        <h5><strong>Part C : EVALUATOR COMMENTS</strong></h5>
        <p><strong>Fill the Comments Below</strong>
          <textarea class="w3-input w3-border" name="comment" id="comment" cols="5"><?php echo $commentDb;  ?></textarea></p>
        <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Submit">

      </form>
    <?php } ?>



        <!--NI UNTUK FYP1 - MULTIMEDIA-- -->

    <?php
    if ($major == 'INFO4993' && $department == 'BIT' && $projectType == 'Multimedia') { ?>

<h2>Instruction</h2>
      <h5> Please fill the form below based on the : <br>    1 - Unsatisfactory , 2 - Satisfactory, 3 - Good, 4 - Excellent. </h5> </br>
      <form action="" method="post" style="overflow-x:auto">
        <div class="tg-wrap">
          <table class="tg">

            <thead>
              <tr>
                <th class="tg-fymr" colspan="7">
                  <h5><b>Part A : PROJECT PROTOTYPE ASSESSMENT</b></h5>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="tg-fymr"><b>Criteria</b></td>
                <td class="tg-fymr"><b>Details</b></td>
                <td class="tg-0pky"> (1)</td>
                <td class="tg-0pky"> (2)</td>
                <td class="tg-0pky"> (3)</td>
                <td class="tg-0pky"> (4)</td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Element Design (Character, Button, etc.)</b></td>
                <td class="tg-0pky">Element was design and presented in high fidelity (hi-fi) and transformed into digital format.<br>
                  The design included all of the proposed elements or components in the project summary.</td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Visual Interface Design</b></td>
                <td class="tg-0pky">Visual elements were carefully created to portray the real product.<br>
                  The interface indicates a well-thought planning for the prototype design.</td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>User Experience</b></td>
                <td class="tg-0pky">All of the prototype design elements were easy to use and adhered to human computer interaction principle.</td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Navigation and Flow</b></td>
                <td class="tg-ucjv">All of the navigation elements were carefully designed and easy to follow.</td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Work Delegation</b></td>
                <td class="tg-0pky">Project development was distributed to a large extent, equally between group members. <br>
                  For individual project, the completed project indicates independent work.</td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="4"></td>
              </tr>
              <tr>
                <td class="tg-fymr" colspan="7">
                  <h5><b>Part B : PROJECT PRESENTATION ASSESSMENT</b></h5>
                </td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Presentation</b></td>
                <td class="tg-0pky">Presenters were all very confident in delivery and they did an excellent job of engaging the examiner. Preparation is the evident.</td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Questions and Answers</b></td>
                <td class="tg-0pky">Presenters understood the project problem and solution. Answers to questions were strengthened by rationalization and explanation.</td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="4"></td>
              </tr>
            </tbody>
          </table>
        </div>


        <h5><strong>Part C : EVALUATOR COMMENTS</strong></h5>
        <p><strong>Fill the Comments Below</strong>
          <textarea class="w3-input w3-border" name="comment" id="comment" cols="5"></textarea></p>
        <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Submit">
      </form>
    <?php } ?>



        <!--NI UNTUK FYP2 - MULTIMEDIA-- -->

    <?php
    if ($major == 'INFO4994' && $department == 'BIT' && $projectType == 'Multimedia') { ?>
    <h2>Instruction</h2>
      <h5> Please fill the form below based on the : <br>    1 - Unsatisfactory , 2 - Satisfactory, 3 - Good, 4 - Excellent. </h5> </br>
      <form action="" method="post" style="overflow-x:auto">

        <div class="tg-wrap">
          <table class="tg">

            <thead>
              <tr>
                <th class="tg-fymr" colspan="7">
                  <h5><b>Part A : PROJECT PROTOTYPE ASSESSMENT</b></h5>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="tg-fymr"><b>Criteria</b></td>
                <td class="tg-fymr"><b>Details</b></td>
                <td class="tg-0pky">(1)</td>
                <td class="tg-0pky">(2)</td>
                <td class="tg-0pky">(3)</td>
                <td class="tg-0pky">(4)</td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Functionality</b></td>
                <td class="tg-0pky">The control, usage of multimedia elements (text, images, audio, video & animation) and navigation in the scenes functioned as planned.</td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="A" name="A" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Interactivity</b></td>
                <td class="tg-0pky">Very high degree of interactivity (action and user inputs are elaborate, 2 way information transfer)</td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="B" name="B" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Designed Elements</b></td>
                <td class="tg-0pky">The usage of graphical elements, audio, colour, and 3D/2D imaging are appropriate for the target users.</td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="C" name="C" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Creativity</b></td>
                <td class="tg-ucjv">It contains unique design/character/storyline and new invention.</td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="D" name="D" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Work Delegation</b></td>
                <td class="tg-0pky">Project development was distributed to a large extent, equally between group members. <br>
                  For individual project, the completed project indicates independent work.</td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="E" name="E" value="4"></td>
              </tr>
              <tr>
                <td class="tg-fymr" colspan="7">
                  <h5><b>Part B : PROJECT PRESENTATION ASSESSMENT</b></h5>
                </td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Presentation</b></td>
                <td class="tg-0pky">Presenters were all very confident in delivery and they did an excellent job of engaging the examiner. Preparation is the evident.</td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="F" name="F" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Questions and Answers</b></td>
                <td class="tg-0pky">Presenters understood the project problem and solution. Answers to questions were strengthened by rationalization and explanation.</td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="G" name="G" value="4"></td>
              </tr>

              <tr>
                <td class="tg-fymr" colspan="7">
                  <h5><b>Part C : PROJECT COMPLEXITY ASSESSMENT</b></h5>
                </td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Functionalities and features</b></td>
                <td class="tg-0pky">Functions and features that require complex programming processes, also include complicated individual/project parts and
                                    features to be completed without error. It meets all the defined functionalities and features.</td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="H" name="H" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Automation of process</b></td>
                <td class="tg-0pky">Successfully automate the manual processes with expected execution and output without any error.</td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="I" name="I" value="4"></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>No of developers’ vs functionalities</b></td>
                <td class="tg-0pky">Ratio of functionalities versus developers.</td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="1"></td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="2"></td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="3"></td>
                <td class="tg-0lax"><input type="radio" id="J" name="J" value="4"></td>
              </tr>


              
            </tbody>
          </table>




        </div>


        <h5><strong>Part C : EVALUATOR COMMENTS</strong></h5>
        <p><strong>Fill the Comments Below</strong>
          <textarea class="w3-input w3-border" name="comment" id="comment" cols="5"></textarea></p>
        <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Submit">
      </form>
    <?php } ?>




        <!--NI UNTUK FYP1 - BCS-- -->

    <?php
    if ($major == 'CSC4993' && $department == 'BCS') { ?>
<h2>Instruction</h2>
      <h5> Please fill the form below based on the : <br>  0- Weak,  1 - Unsatisfactory , 2 - Satisfactory, 3 - Good, 4 - Exemplary. </h5> </br>
    
      <form action="" method="post" style="overflow-x:auto">

        <div class="tg-wrap">
          <table class="tg">
            <thead>
              <tr>
                <th class="tg-0pky"></th>
                <th class="tg-0pky">0 </th>
                <th class="tg-0pky">1 </th>
                <th class="tg-0pky">2 </th>
                <th class="tg-0pky">3 </th>
                <th class="tg-0pky">4 </th>
              </tr>
            </thead>

            <tbody>

              <tr>
                <td class="tg-0pky"><b>Poster Demonstration</b></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="0"><br />
                  <label for="0">Irrelevant. Not helpful.</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="1"><br />
                  <label for="1">Insufficient</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="2"><br />
                  <label for="2">Informative but not attractive</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="3"><br />
                  <label for="3">Well presented</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="4"><br />
                  <label for="4">Enhance understanding about the project, attractive, professional, practical</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Presentation skills</b></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="0"><br />
                  <label for="0">Difficult to understand.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="1"><br />
                  <label for="0">Lack of confidence. Not prepared. Not professional.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="2"><br />
                  <label for="0">Good command of English. Not well prepared.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="3"><br />
                  <label for="0">Good command of English. Professional look. Lack Confident.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="4"><br />
                  <label for="0">Excellent command of English. Convincing. Professional look. Confident.</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Knowledge about the project (Response to Q&A)</b></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="0"><br />
                  <label for="0">Unable to handle most Q&A. Response not coherence with poster and demo. Contradicting.</label></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="1"><br />
                  <label for="0">No or very less knowledge of both problem and solution.</label></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="2"><br />
                  <label for="0">Seems novice. Only able to answer basic questions.</label></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="3"><br />
                  <label for="0">Able to handle most Q&A</label>.</td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="4"><br />
                  <label for="0">Able to handle all Q&A. Answer by rationalization and explanation.</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Progress</b></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="0"><br />
                  <label for="0">Require revision on Problem statement and objectives.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="1"><br />
                  <label for="0">Objectives are clear, but methodology not presented.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="2"><br />
                  <label for="0">Objectives are clear, but requires revision of methodology.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="3"><br />
                  <label for="0">Objectives & methodology are clear, but requires more than 7 weeks of next Semester to complete.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="4"><br />
                  <label for="0">Half-way done. By Week 7 in next Semester, the project will complete.</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Complexity & Practicality</b></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="0"><br />
                  <label for="0">Not relevant to Computer Science.</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="1"><br />
                  <label for="0">Limited use of computing knowledge and technology.</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="2"><br />
                  <label for="0">Sufficient use of computing knowledge and technology but the practicality for other applications is not clear</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="3"><br />
                  <label for="0">Decent use of computing knowledge and technology for Computer Science applications</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="4"><br />
                  <label for="0">Decent use of computing knowledge and technology for practical applications of other domains.</label></td>
              </tr>
            </tbody>
          </table><br />

          <h4><strong>Part B : EVALUATOR COMMENTS</strong></h4>
          <p><strong>Fill the Comments Below</strong>
            <textarea class="w3-input w3-border" name="abstract" id="abstract"></textarea></p>
          <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Submit">
      </form>
    <?php } ?>


        <!--NI UNTUK FYP2 - BCS-- -->
    <?php
    if ($major == 'CSC4994' && $department == 'BCS') { ?>

<h2>Instruction</h2>
      <h5> Please fill the form below based on the : <br>  0- Weak,  1 - Unsatisfactory , 2 - Satisfactory, 3 - Good, 4 - Exemplary. </h5> </br>
      <form action="" method="post" style="overflow-x:auto" >


        <div class="tg-wrap">
          <table class="tg">
            <thead>
              <tr>
                <th class="tg-0pky"></th>
                <th class="tg-0pky">0 </th>
                <th class="tg-0pky">1 </th>
                <th class="tg-0pky">2 </th>
                <th class="tg-0pky">3 </th>
                <th class="tg-0pky">4 </th>
              </tr>
            </thead>

            <tbody>

              <tr>
                <td class="tg-0pky"><b>Poster Demonstration</b></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="0"><br />
                  <label for="0">Irrelevant. Not helpful.</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="1"><br />
                  <label for="1">Insufficient</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="2"><br />
                  <label for="2">Informative but not attractive</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="3"><br />
                  <label for="3">Well presented</label></td>
                <td class="tg-0pky"><input type="radio" id="A" name="A" value="4"><br />
                  <label for="4">Enhance understanding about the project, attractive, professional, practical</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Presentation skills</b></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="0"><br />
                  <label for="0">Difficult to understand.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="1"><br />
                  <label for="0">Lack of confidence. Not prepared. Not professional.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="2"><br />
                  <label for="0">Good command of English. Not well prepared.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="3"><br />
                  <label for="0">Good command of English. Professional look. Lack Confident.</label></td>
                <td class="tg-0pky"><input type="radio" id="C" name="C" value="4"><br />
                  <label for="0">Excellent command of English. Convincing. Professional look. Confident.</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Knowledge about the project (Response to Q&A)</b></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="0"><br />
                  <label for="0">Unable to handle most Q&A. Response not coherence with poster and demo. Contradicting.</label></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="1"><br />
                  <label for="0">No or very less knowledge of both problem and solution.</label></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="2"><br />
                  <label for="0">Seems novice. Only able to answer basic questions.</label></td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="3"><br />
                  <label for="0">Able to handle most Q&A</label>.</td>
                <td class="tg-0pky"><input type="radio" id="D" name="D" value="4"><br />
                  <label for="0">Able to handle all Q&A. Full knowledge of problem and solution. Answer by rationalization and explanation.</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Complete and Tested</b></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="0"><br />
                  <label for="0">Not complete. None of the objectives achieved.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="1"><br />
                  <label for="0">More objectives not achieved. Not tested.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="2"><br />
                  <label for="0">Few objectives not achieved. Tested.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="3"><br />
                  <label for="0">All objectives achieved. Tested.</label></td>
                <td class="tg-0pky"><input type="radio" id="E" name="E" value="4"><br />
                  <label for="0">Complete beyond achieving objectives. Outcome has been validated (test).</label></td>
              </tr>
              <tr>
                <td class="tg-0pky"><b>Complexity & Practicality</b></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="0"><br />
                  <label for="0">Not relevant to Computer Science.</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="1"><br />
                  <label for="0">Limited use of computing knowledge and technology.</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="2"><br />
                  <label for="0">Sufficient use of computing knowledge and technology but the practicality for other applications is not clear</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="3"><br />
                  <label for="0">Decent use of computing knowledge and technology for Computer Science applications</label></td>
                <td class="tg-0pky"><input type="radio" id="F" name="F" value="4"><br />
                  <label for="0">Decent use of computing knowledge and technology for practical applications of other domains.</label></td>
              </tr>
            </tbody>
          </table><br />

          <h4><strong>Part B : EVALUATOR COMMENTS</strong></h4>
          <p><strong>Fill the Comments Below</strong>
            <textarea class="w3-input w3-border" name="abstract" id="abstract"></textarea></p>
          <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Submit">
      </form>
    <?php } ?>


  </div>
</body>
</div>
<?php include 'footer.php'; ?>

</html>