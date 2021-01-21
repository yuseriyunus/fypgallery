<?php
require 'db.php';
require 'navbar.php';
include 'session.php';

if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('index.php')</script>";
}

if (isset($_GET['projectID'])) {
    $gProjectID = $_GET['projectID'];
    $srch = mysqli_query($con, "SELECT * FROM `project` INNER JOIN user ON project.svID=user.id WHERE `projectID` = $gProjectID");
    if ($srch->num_rows > 0) {
        while ($row = $srch->fetch_assoc()) {
            $projectName = $row['projectName'];
            $description = $row['description'];
            $projectType = $row['projectType'];
            $department = $row['department'];
            $major = $row['major'];
            $svID = $row['svID'];
        }
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

if (isset($_POST['Edit'])) {

    $pID = $gProjectID;
    $evaluator1 = $svID;

    if ($_POST['evaluator2'] === "") {
        $evaluator2 = 'NULL';
    } else {
        $evaluator2 = $_POST['evaluator2'];
    }

    if ($_POST['evaluator3'] === "") {
        $evaluator3 = 'NULL';
    } else {
        $evaluator3 = $_POST['evaluator3'];
    }

    //tak ada $errorMsg proceed upload ke db
    $sqlAdd = "INSERT INTO `evaluation`(`evaluation`, `projectID`, `evaluatorID1`, `evaluatorID2`, `evaluatorID3`, `mark1`, `mark2`, `mark3`, `totalMark`) VALUES (NULL,'$pID',NULL,'$evaluator2','$evaluator3',NULL,NULL,NULL,NULL)";
    if (mysqli_query($con, $sqlAdd)) {
        $gProjectID = $pID;
        echo "<script>alert ('New record successfully inserted!') </script>";
        echo "<script>window.location.assign('assign-project.php')</script>";
    }
    //  elseif ($evaluator1 == $svID || $evaluator2 == $svID || $evaluator3 == $svID) {
    //     echo "<script>alert ('Evaluator cannot same with supervisor')</script>";
    // }
    else {
        echo "<script>alert ('Error occured while uploading your project') </script>";
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

            <h3 class="w3-center">Assign Examiner</h3>
            <div style="margin-top:48px" class="w3-center">


                <form action="" method="POST" enctype="multipart/form-data" class="w3-center" style="width:40%;">
                
                <p><strong>Project Title</strong>
                    <input class="w3-input w3-border" type="text" size="40" value="<?php echo $projectName; ?>" required disabled hidden>


                    <p><strong>Examiner Name 1 (Supervisor)</strong>
                        <input class="w3-input w3-border" type="text" size="40" value="<?php echo $nameSv; ?>" required disabled>
                    </p>

                    <p><strong>Examiner Name 2 </strong><select class="w3-input w3-border" id="evaluator2" name="evaluator2">
                            <option value="<?php echo ""; ?>"><?php echo "Please Select Examiner "; ?></option>
                            <?php
                            $srchId2 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'lecturer'");
                            while ($row = mysqli_fetch_array($srchId2)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="">Remove Evaluator</option>
                        </select></p>

                    <p><strong>Examiner Name 3</strong><select class="w3-input w3-border" id="evaluator3" name="evaluator3">
                            <option value="<?php echo ""; ?>"><?php echo "Please Select Examiner"; ?></option>
                            <?php
                            $srchId3 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'lecturer'");
                            while ($row = mysqli_fetch_array($srchId3)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="">Remove Evaluator</option>
                        </select>


                        </br>
                        <input class="w3-button w3-black w3-center" type="submit" value="Submit" name="Edit">


                </form>

            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>