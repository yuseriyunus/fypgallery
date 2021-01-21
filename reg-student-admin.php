<?php
include 'session.php';
include 'navbar.php';
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

  <h3 class="w3-center">Please Fill this Form to Register</h3>
  <div style="margin-top:48px" class="w3-center">
    <form action="reg-student-pro.php" method="POST" class="w3-center" style ="width:40%;">

      <p><strong>Matric Number</strong><input class="w3-input w3-border" type="number" size="40" placeholder="Enter Matric Number" name="mno" id="mno" required></p>
      <p><strong>Name</strong> <input style="text-transform:uppercase" class="w3-input w3-border" type="text" size="40" placeholder="Enter Full Name" name="sname" id="sname" required></p>
      
      <p><strong>Course</strong><select class="w3-input w3-border" name="sdepartment" id="sdepartment" required>
                <option value="BIT">Bachelor in Information Technology (BIT)</option>
                <option value="BCS"> Bachelor of Computer Science (BCS)</option>
              </select></p>
      <p><strong>Email</strong><input class="w3-input w3-border" type="email" size="40" placeholder="Enter Email" name="semail" id="semail" required></p>
      <p><strong>Phone Number</strong><input class="w3-input w3-border" type="number" size="40" placeholder="Enter Phone Number" name="phone" id="phone" required></p>
      <p><strong>Password</strong><input class="w3-input w3-border" type="password" size="40" placeholder="Enter Password" name="spsw" id="spsw" required></p>
      <p><strong>Confirm Password</strong><input class="w3-input w3-border" type="password" size="40" placeholder="Confirm Password" name="spswrpt" id="spswrpt" required></p>
    
        <button class="w3-button w3-black w3-center" type="submit" size="40" name="register-submit" class="registerbtn">
     Register
        </button>
    </form>
    
  </div>




</div>
</body>

<?php include 'footer.php';?>