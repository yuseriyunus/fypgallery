<?php
require 'db.php';
include 'navbarlecturer.php';

session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
  echo "<script>window.location.assign('index.php')</script>";
}

$sqlname = mysqli_query($con, "SELECT `id`, `name`, `email` FROM user WHERE id = '$_SESSION[mysesi]'");
if ($sqlname->num_rows > 0) {
  while ($row = $sqlname->fetch_assoc()) {
    $sessionName = $row['name'];
    $sessionId = $row['id'];
    $sessionmail = $row['email'];
  }
}

if (isset($_POST['submit'])) {
  //form details
  $projectTitle = $_POST['ptitle'];
  $projectDomain = $_POST['domain'];
  $department = $_POST['department'];
  $description = $_POST['description'];
  $projectType = $_POST['TOP'];
  



  //tak ada $errorMsg proceed upload ke db
  if (!isset($errorMsg)) {
    $sqlAdd = (mysqli_query($con, "INSERT INTO `availabletitle`(`availabeID`, `svID`, `title`, `description`, `projectType`, `projectCategory`, `project`) VALUES (NULL,'$sessionId','$projectTitle','$description','$projectDomain','$projectType','$department')"));
    if (!isset($error)) {
      echo "<script>alert ('New record successfully inserted!') </script>";
      echo "<script>window.location.assign('all-title-lecturer.php')</script>";
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
</style>

<body>


  <br>
  <div class="container">
    <div class="w3-center" style="padding:5% 40px" id="contact">

      <h3 class="w3-center">FYP Idea</h3>
      <div style="margin-top:48px" class="w3-center">


        <form action="" method="POST" enctype="multipart/form-data" class="w3-center" style="width:40%;">


          <p><strong>Name</strong><input class="w3-input w3-border" type="text" id="studentId1" id="studentId1" value="<?php echo $sessionName; ?>" disabled=""></p>
          <p><strong>Email</strong><input class="w3-input w3-border" type="email" name="email" id="email"     value="<?php echo $sessionmail; ?>" disabled=""></p>

          <p><strong>Project Title</strong><input class="w3-input w3-border" type="text" size="50" id="ptitle" name="ptitle" placeholder="Enter Your Project Title"></p>

          <p><strong>Project Domain</strong><select class="w3-input w3-border" id="domain" name="domain"> /* sama dgn department kut */
              <option value="Individual">Individual</option>
              <option value="Group">Group</option>
              <option value="Individual/Group">Individual/Group</option>
            </select></p>
        
            <p><strong>Project Type</strong><select class="w3-input w3-border" id="TOP" name="TOP">
              <option value="System Development">System Development</option>
              <option value="Multimedia">Multimedia Project</option>
              <option value="Research">Research</option>
            </select></p>


            <p><strong>Course</strong><select class="w3-input w3-border" id="department" name="department"> /* sama dgn department kut */
              <option value="BIT">Bachelor in Information Technology (BIT)</option>
              <option value="BCS">Bachelor of Computer Science (BCS)</option>
            </select></p>

          <p><strong>Project Description</strong><textarea class="w3-input w3-border" name="description" id="description" cols="50" rows="10" maxlength="3000"></textarea></p>

         
          </br>
          <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="submit">


        </form>

      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>