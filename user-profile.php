<?php
require 'db.php';
include 'session.php';


if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('login-student.php')</script>";
} else {
    $sessionID = $_SESSION['mysesi'];
}

if (isset($sessionID)) {
    $userID = $sessionID;
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


?>



<!DOCTYPE html>
<html>
<title>Your Profile</title>

<style>
    p {
        text-align: left;
    }
</style>

<body>
    <br>
    <div class="container">

    <div style="margin-top:48px" class="w3-center">
    <h3 class="w3-center">Your Profile</h3>
        <div class="w3-center" style="padding: 20px" id="contact">
            <?php
            if ($type == 'student') {
            ?>


                    <form action="" method="POST" class="w3-center" style="width:40%;">

                        <p><strong>Matric No:  </strong> <?php echo $userID; ?>

                        <p><strong>Full Name:  </strong><?php echo $name; ?>

                        <p><strong>Course :  </strong><?php echo $department; ?>

                        <p><strong>Section Number:  </strong><?php echo $sectionNo; ?>

                        <p><strong>Email:  </strong><?php echo $email; ?>

                        <p><strong>Phone Number:  </strong><?php echo $phone; ?>

                        <p><a href="profile.php" class="w3-button w3-light-grey w3-center"><i class="fa fa-pencil"></i> Edit Profile</a></button></p>

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


                        <p><strong>ID No : </strong> <?php echo $userID; ?>
                        <p><strong>Full Name : </strong><?php echo $name; ?>
                        <p><strong>Department : </strong><?php echo $department; ?>
                        <p><strong>Specialization : </strong><?php echo $specialization; ?>
                        <p><strong>Room Number:</strong><?php echo $roomNo; ?>
                        <p><strong>Section Number:</strong><?php echo $sectionNo; ?>
                        <p><strong>Email: </strong><?php echo $email; ?>
                        <p><strong>Phone Number: </strong><?php echo $phone; ?>

                        <p><a href="profile.php" class="w3-button w3-light-grey w3-center"><i class="fa fa-pencil"></i> Edit Profile</a></button></p>

                    </form>

                <?php
                }
                ?>
                Change your password <a href="change-password.php?ID=<?php echo $sessionID; ?>">here</a> </br></br>
                <a href="profile.php" class="w3-button w3-black "><i class="fa fa-pencil"></i> Back</a></button>
                </div>
                </br>
        </div>
</body>


<?php
include 'footer.php';
?>

</html>