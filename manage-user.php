<?php
require 'db.php';
require 'navbar.php';
include 'session.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('login-student.php')</script>";
}

if (isset($_GET['manage'])) {
    $userID = $_GET['manage'];
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
<title>Your Details</title>

<style>
p{
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
    
            <form action="manage-user.php" method="GET" class="w3-center" style ="width:40%;">
               

            <p><strong>Matric No: </strong>
            <input class="w3-input w3-border" value="<?php echo $userID; ?>" required disabled>

            <p><strong>Full Name: </strong>
            <input class="w3-input w3-border" value="<?php echo $name; ?>" required disabled></p>

            <p><strong>Course</strong> 
            <input class="w3-input w3-border" value="<?php echo $department; ?>" required disabled></p>

            <p><strong>Section Number:</strong>
            <input class="w3-input w3-border" value="<?php echo $sectionNo; ?>" required disabled></p>

            <p><strong>Email: </strong>
            <input class="w3-input w3-border" value="<?php echo $email; ?>" required disabled></p>

            <p><strong>Phone Number: </strong>
            <input class="w3-input w3-border" value="<?php echo $phone; ?>" required disabled></p>

            <input type="button"  class="w3-button w3-black w3-center" value="Update Details"  onclick="window.location.href='edit-information.php?edit=<?php $edit = $userID;
                                                                                                                                echo $edit; ?>'" />
            <input type="button" class="w3-button w3-red w3-center" value="Delete User" onclick="window.location.href='manage-user.php?deleteStudent=<?php $deleteStudent = $userID;
                                                                                                                                echo $userID; ?>'" />
            <a href="user.php?view=<?php $view = 'student';
                                        echo $view; ?>" class="w3-button w3-black w3-center"><i class="fa fa-th"></i>BACK</a>
            </form>


        <?php
        }
        ?>

        <?php
        if ($type == 'lecturer') {
        ?>
            <form action="manage-user.php" method="GET" class="w3-center" style ="width:40%;">
            

            <p><strong>Staff ID: </strong>
            <input class="w3-input w3-border" value="<?php echo $userID; ?>" required disabled></p>

            <p><strong>Full Name: </strong>
            <input class="w3-input w3-border" value="<?php echo $name; ?>" required disabled></p>
                     
            <p><strong>Department</strong> 
            <input class="w3-input w3-border" value="<?php echo $department; ?>" required disabled></p>
                       
            <p><strong>Specialization: </strong>
            <input class="w3-input w3-border" value="<?php echo $specialization; ?>" required disabled></p>
             
            <p><strong>Room Number: </strong>
            <input class="w3-input w3-border" value="<?php echo $roomNo; ?>" required disabled></p>
                        
            <p><strong>Section Number:</strong>
            <input class="w3-input w3-border" value="<?php echo $sectionNo; ?>" required disabled></p>
                        
            <p><strong>Email: </strong>
            <input class="w3-input w3-border" value="<?php echo $email; ?>" required disabled></p>
            
            <p><strong>Phone Number: </strong>
            <input class="w3-input w3-border" value="<?php echo $phone; ?>" required disabled></p>
            
            
            <input type="button" class="w3-button w3-black w3-center" value="Update Details" onclick="window.location.href='edit-information.php?edit=<?php $edit = $userID;
                                                                                                                                echo $edit; ?>'" />
            <input type="button" class="w3-button w3-red w3-center" value="Delete User" onclick="window.location.href='manage-user.php?deleteLecturer=<?php $deleteLecturer = $userID;
                                                                                                                                echo $userID; ?>'" />

            <a href="user.php?view=<?php $view = 'lecturer';echo $view; ?>" class="w3-button w3-black w3-center"></i>BACK</a>
                   
            </form>

        <?php
        }
        ?>
    </div></div>
</body>

</html>
<?php
include 'footer.php';
?>