<?php
require 'db.php';
require 'navbar.php';
include 'session.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('login-student.php')</script>";
}

if (isset($_GET['edit'])) {
    $userID = $_GET['edit'];
    $srch = mysqli_query($con, "SELECT * FROM `user` WHERE id = $userID");
    if ($srch->num_rows > 0) {
        while ($row = $srch->fetch_assoc()) {
            $name = $row['name'];
            $type = $row['type'];
            $department = $row['department'];
            $email = $row['email'];
            $phone = $row['phone'];
            $roomNo = $row['roomNo'];
            $specialization = $row['specialization'];
            $sectionNo = $row['sectionNo'];
        }
    }
}

if (isset($_POST['submitStudent'])) {

    $fId = $_POST['userIDs'];
    $fName = $_POST['name'];
    $fDepartment = $_POST['departments'];
    $fSectionNo = $_POST['sectionNo'];
    $fEmail = $_POST['email'];
    $fPhone = $_POST['phone'];

    $sqlStudent = "UPDATE `user` SET `name`='$fName',`department`='$fDepartment',`email`='$fEmail',`phone`='$fPhone' ,`roomNo`=NULL,`specialization`=NULL,`sectionNo`='$fSectionNo' WHERE `id` = '$fId'";
    if (!mysqli_query($con, $sqlStudent)) {
        $view = 'student';
        $type = 'student';
        $edit = $fId;
        echo "<script>alert('Update Failed!') </script>";
        echo "<script>window.location.assign('edit-information.php?edit=$id')</script>";
    } else {
        $view = 'student';
        $type = 'student';
        $manage = $fId;
        echo "<script>alert('Update Successfully!')</script>";
        echo "<script>window.location.assign('manage-user.php?manage=$manage')</script>";
    }
}

if (isset($_POST['submitLecturer'])) {

    $fId = $_POST['userIDs'];
    $fName = $_POST['name'];
    $fDepartment = $_POST['departments'];
    $fSectionNo = $_POST['sectionNo'];
    $fEmail = $_POST['email'];
    $fPhone = $_POST['phone'];
    $fSpecialization = $_POST['specialization'];
    $fRoomNo = $_POST['roomNo'];

    $sqlLecturer = "UPDATE `user` SET `name`='$fName',`department`='$fDepartment',`email`='$fEmail',`phone`='$fPhone' ,`roomNo`='$fRoomNo',`specialization`='$fSpecialization',`sectionNo`='$fSectionNo' WHERE `id` = '$fId'";
    if (!mysqli_query($con, $sqlLecturer)) {
        $view = 'student';
        $type = 'student';
        $edit = $fId;
        echo "<script>alert('Update Failed!') </script>";
        echo "<script>window.location.assign('edit-information.php?edit=$id')</script>";
    } else {
        $view = 'lecturer';
        $type = 'lecturer';
        $manage = $fId;
        echo "<script>alert('Update Successfully!')</script>";
        echo "<script>window.location.assign('manage-user.php?manage=$manage')</script>";
    }
}

if (isset($_POST['resetStudent'])) {
    $resetStudent = "UPDATE `user` SET `password`='$userID' WHERE `id` = '$userID'";
    if (!mysqli_query($con, $resetStudent)) {
        $view = 'student';
        $type = 'student';
        $edit = $userID;
        echo "<script>alert('Update Failed!') </script>";
        echo "<script>window.location.assign('edit-information.php?edit=$id')</script>";
    } else {
        $view = 'student';
        $type = 'student';
        $manage = $userID;
        echo "<script>alert('Reset password to default successfully!')</script>";
        echo "<script>window.location.assign('manage-user.php?manage=$manage')</script>";
    }
}


if (isset($_GET['deleteStudent'])) {
    $id = $_GET['deleteStudent'];
    $sqlStudent = "DELETE FROM `user` WHERE id = '$id'";
    if (!mysqli_query($con, $sqlStudent)) {
        $view = 'student';
        $type = 'student';
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('user.php?view=student')</script>";
    } else {
        $view = 'student';
        $type = 'student';
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('user.php?view=student')</script>";
    }
}

if (isset($_GET['deleteLecturer'])) {
    $id = $_GET['deleteLecturer'];
    $sqlLecturer = "DELETE FROM `user` WHERE id = '$id'";
    if (!mysqli_query($con, $sqlLecturer)) {
        $view = 'lecturer';
        $type = 'lecturer';
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('user.php?view=lecturer')</script>";
    } else {
        $view = 'lecturer';
        $type = 'lecturer';
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('user.php?view=lecturer')</script>";
    }
}



?>



<!DOCTYPE html>
<html>
<title>Edit Your Details</title>

<style>
    p {
        text-align: left;
    }
</style>

<body>
    <br>
    <div class="container">
        <div class="w3-center" style="padding:5% 40px" id="contact">
            <?php
            if ($type == 'student') {
            ?>
                <h3 class="w3-center">Update Details</h3>
                <div style="margin-top:48px" class="w3-center">

                    <form action="" method="POST" class="w3-center" style="width:40%;">

                        <p><strong>Matric No: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $userID; ?>" required disabled>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $userID; ?>" name="userIDs" id="userIDs" required hidden></p>

                        <p><strong>Full Name: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $name; ?>" id="name" name="name" required></p>

                        <p><strong>Course</strong><select class="w3-input w3-border" name="departments" id="departments" required>
                                <option value="BIT">Bachelor in Information Technology (BIT)</option>
                                <option value="BCS"> Bachelor of Computer Science (BCS)</option>
                            </select></p>

                        <p><strong>Section Number:</strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $sectionNo; ?>" id="sectionNo" name="sectionNo" required></p>

                        <p><strong>Email: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $email; ?>" id="email" name="email" required></p>

                        <p><strong>Phone Number: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $phone; ?>" id="phone" name="phone" required></p>

                            <button class="w3-button w3-black w3-center" type="submit" size="40" name="submitLecturer" class="registerbtn">Update Details</button>
                        <button class="w3-button w3-black w3-center" type="submit" size="40" name="resetStudent" class="registerbtn">Reset Password</button></br></br>
                        <input type="button" class="w3-button w3-red w3-center" value="Delete User" onclick="window.location.href='manage-user.php?deleteStudent=<?php $deleteStudent = $userID;
                                                                                                                                echo $userID; ?>'" /> </br></br>
                        <?php
                        ?>
                    </form>

                <?php
            }
                ?>


                <?php
                if ($type == 'lecturer') {
                ?>
                    <form action="" method="POST" class="w3-center" style="width:40%;">


                        <p><strong>Matric No: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $userID; ?>" required disabled>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $userID; ?>" name="userIDs" id="userIDs" required hidden></p>

                        <p><strong>Full Name: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $name; ?>" id="name" name="name" required></p>

                        <p><strong>Department</strong><select class="w3-input w3-border" name="departments" id="departments" required>
                                <option value="BIT">Bachelor in Information Technology (BIT)</option>
                                <option value="BCS"> Bachelor of Computer Science (BCS)</option>
                            </select></p>

                        <p><strong>Specialization</strong><select class="w3-input w3-border" name="specialization" id="specialization" required>
                                <option value="Multimedia">Multimedia</option>
                                <option value="System Development">System Development</option>
                                <option value="Research">Research</option>
                            </select></p>

                        <p><strong>Room Number:</strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $sectionNo; ?>" id="roomNo" name="roomNo" required></p>

                        <p><strong>Section Number:</strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $sectionNo; ?>" id="sectionNo" name="sectionNo" required></p>

                        <p><strong>Email: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $email; ?>" id="email" name="email" required></p>

                        <p><strong>Phone Number: </strong>
                            <input class="w3-input w3-border" type="text" size="40" value="<?php echo $phone; ?>" id="phone" name="phone" required></p>

                        <button class="w3-button w3-black w3-center" type="submit" size="40" name="submitLecturer" class="registerbtn">Update Details</button>
                        <button class="w3-button w3-black w3-center" type="submit" size="40" name="resetStudent" class="registerbtn">Reset Password</button></br></br>
                        <input type="button" class="w3-button w3-red w3-center" value="Delete User" onclick="window.location.href='manage-user.php?deleteStudent=<?php $deleteStudent = $userID;
                                                                                                                                echo $userID; ?>'" /> </br></br>
                    </form>

                <?php
                }
                ?>

                </div>
        </div>
</body>


<?php
include 'footer.php';
?>

</html>