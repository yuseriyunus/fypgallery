<?php

require 'db.php';
include 'navbar.php';

if (isset($_POST['login'])) {


  $id = $_POST['email'];
  $password = $_POST['password'];

  echo $id;
  echo $password;

  $res = $con->query("SELECT * FROM user where id='$id' and password='$password'");
  $row = $res->fetch_assoc();

  $user = $row['id'];
  $pass = $row['password'];
  $type = $row['type'];

  if ($user == $id && $pass = $password) {
    session_start();
    if ($type == "admin") {
      $_SESSION['id'] = $user;

      $_SESSION['mytype'] = $type;
      echo "<script>window.location.assign('user.php?view=lecturer')</script>";
    } else if ($type == "student") {
      $_SESSION['mysesi'] = $user;
      $_SESSION['id'] = $user;
      $_SESSION['mytype'] = $type;
      echo "<script>window.location.assign('student-landing.php')</script>";
    } else if ($type == "lecturer") {
      $_SESSION['mysesi'] = $user;
      $_SESSION['mytype'] = "lecturer";
      echo "<script>window.location.assign('landing-lect.php')</script>";
    } else {
      echo '<script>alert("Wrong Credential");</script>';
    }
  } else {

    echo '<script>alert("Enter Correct Username or Password !");</script>';

    echo $id;
    echo $password;
  }
}




?>

<style>
  table {
    border-collapse: collapse;
    width: 90%;
    border: 2px solid black;
    margin-left: auto;
    margin-right: auto;
  }
</style>
<!DOCTYPE html>
<html>
<title>Login Page</title>


<body>

  </form>
  <div class="container">
    <div class="w3-center" style="padding:10% 40px" id="contact">

      <h3 class="w3-center">LOGIN</h3>
      <div style="margin-top:48px" class="w3-center">
        <form action="login.php" method="post" class="w3-center" style="width:40%;">

          <p><input class="w3-input w3-border" type="text" size="40" placeholder="Enter Matric Number" name="email" id="email" required></p>
          <p><input class="w3-input w3-border" type="password" size="40" placeholder="Enter Password" name="password" id="password" required></p>
          <p></br>
            <button class="w3-button w3-black w3-center" type="submit" size="40" name="login" class="registerbtn">
              <i class="fa fa-sign-in w3-center"></i> LOGIN
            </button>
          </p>
        </form>
        <p>New user? <a href="reg-student.php">Click here to Register</a>.</p>
      </div>
    </div>

</body>
<?php include 'footer.php'; ?>

</html>