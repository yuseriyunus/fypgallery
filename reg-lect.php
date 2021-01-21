<?php

require 'navbar.php';
include 'session.php';

if (isset($_POST['register-submit'])) {
  $id = $_POST['mno'];
  $sname = $_POST['sname'];
  // $spsw = $_POST['spsw'];
  // $spswrpt = $_POST['spswrpt'];
  $sdepartment = $_POST['sdepartment'];
  $semail = $_POST['semail'];
  $phone = $_POST['phone'];
  $specialization = $_POST['specialization'];
  $roomNo = $_POST['room'];
  $sectionNo = $_POST['section'];

  $sql = "INSERT INTO user (id, name, password, type, department, email, phone, roomNo, sectionNO, specialization) VALUES ('$id', '$sname', '$id','lecturer' ,'$sdepartment', '$semail','$phone', '$roomNo', '$sectionNo', '$specialization' );";

  if (!mysqli_query($con, $sql)) {
    echo "<script>alert ('Error occured when creating account. Try again.') </script>";
    echo "<script>window.location.assign('reg-lect.php')</script>";
  } else {
    $view = 'lecturer';
    echo "<script>window.location.assign('user.php?view=lecturer')</script>";
  }
}

?>
<!DOCTYPE html>
<html>
<title>Registration Page</title>


<style>
p{
  text-align: left;
}
</style>


<body>

  <br>
<div class="container">
  <div class="w3-center" style="padding:5% 40px" id="contact">

  <h3 class="w3-center">Register Lecturer</h3>

  <div style="margin-top:48px" class="w3-center">
    <form action="" method="POST" class="w3-center" style ="width:40%;">

      <p><strong>Staff ID</strong><input class="w3-input w3-border" type="number" size="40" placeholder="Enter Matric Number" name="mno" id="mno" required></p>
      <p><strong>Name</strong> <input style="text-transform:uppercase" class="w3-input w3-border" type="text" size="40" placeholder="Enter Full Name" name="sname" id="sname" required></p>
      <p><strong>Department</strong><select class="w3-input w3-border" name="sdepartment" id="sdepartment" required>
                <option value="BIT">Bachelor in Information Technology (BIT)</option>
                <option value="BCS"> Bachelor of Computer Science (BCS)</option>
              </select></p>

      <p><strong>Specialization</strong><select class="w3-input w3-border" name="specialization" id="specialization" required>
                <option value="Multimedia">Multimedia</option>
                <option value="System Development">System Development</option>
                <option value="Research">Research</option>
              </select></p>

      <p><strong>Room Number</strong><input class="w3-input w3-border" type="text" size="40" placeholder="Enter Room Number" name="room" id="room" required></p>
      <p><strong>Section</strong><input class="w3-input w3-border" type="number" size="40" placeholder="Enter Section" name="section" id="section" required></p>
      <p><strong>Email</strong><input class="w3-input w3-border" type="email" size="40" placeholder="Enter Email" name="semail" id="semail" required></p>
      <p><strong>Phone Number</strong><input class="w3-input w3-border" type="number" size="40" placeholder="Enter Phone Number" name="phone" id="phone" required></p>

          <!--

            <p><strong>Password</strong><input class="w3-input w3-border" type="password" size="40" placeholder="Enter Password" name="spsw" id="spsw" required></p>
            <p><strong>Confirm Password</strong><input class="w3-input w3-border" type="password" size="40" placeholder="Confirm Password" name="spswrpt" id="spswrpt" required></p>
            
            <label>Password: </label>
              <input type="password" size="40" placeholder="Enter Password" name="spsw" id="spsw" required>

            <label>Confirm Password: </label>
              <input type="password" size="40" placeholder="Repeat Password" name="spswrpt" id="spswrpt" required>  -->
        

              <button class="w3-button w3-black w3-center" type="submit" name="register-submit" class="registerbtn">
          Register Lecturer
          </button>


      </form>
    </div>
  </div>
</body>

</html>

<?php
include 'footer.php';
?>