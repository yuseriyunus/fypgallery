<?php
require 'db.php';
include 'session.php';
session_start();

if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('index.php')</script>";
}

if (isset($_GET['ID'])) {
    $sessionID = $_GET['ID'];

    $srch = mysqli_query($con, "SELECT * FROM `user` WHERE `id` = '$sessionID'");
    if ($srch->num_rows > 0) {
        while ($row = $srch->fetch_assoc()) {
            $password = $row['password'];
        }
    }
}

if (isset($_POST['Submit'])) {
    $passwordDB = $password;
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPassword2 = $_POST['newPassword2'];

    if ($oldPassword == $passwordDB) {
        if ($newPassword == $newPassword2) {
            $sql = " UPDATE `user` SET `password` = '$newPassword' WHERE `user`.`id` = '$sessionID'";
            if (!mysqli_query($con, $sql)) {
                echo "<script>alert('Update Failed!') </script>";
                echo "<script>window.location.assign('profile.php')</script>";
            } else {
                echo "<script>alert('Update Successfully!')</script>";
                echo "<script>window.location.assign('profile.php')</script>";
            }
        } else {
            echo "<script>alert('Your new password is not match')</script>";
        }
    } else {
        echo "<script>alert('Your current password is incorrect')</script>";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="w3-center" style="padding:5% 40px" id="contact">

            <h3 class="w3-center">Change Password</h3>
            <div style="margin-top:48px" class="w3-center">


                <form action="" method="POST" class="w3-center" style="width:20%;">

                <p><strong>Enter Your old password </strong>
                <input type="password" id="oldPassword" name="oldPassword"  class="w3-input w3-border" >

                <p><strong>Enter Your New password </strong>
                <input type="password" id="newPassword" name="newPassword"  class="w3-input w3-border" >

                <p><strong>Re-Enter Your New Password </strong>
                <input type="password" id="newPassword2" name="newPassword2"  class="w3-input w3-border" > </br>
 

    <button class="w3-button w3-black w3-center" type="sumbit" id="Submit" name="Submit">Change Password </button>

</div></div>

    </body>
    <?php include 'footer.php'; ?>
</html>