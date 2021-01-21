<?php
require 'db.php';
require 'navbar.php';
include 'session.php';
//session_start();


if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('index.php')</script>";
}

$sqlname = mysqli_query($con, "SELECT `id`, `name`, `email` FROM user WHERE id = '$_SESSION[id]'");
if ($sqlname->num_rows > 0) {
    while ($row = $sqlname->fetch_assoc()) {
        $sessionName = $row['name'];
        $sessionId = $row['id'];
        $sessionmail = $row['email'];
    }
}


if (isset($_GET['projectID'])) {
    $gProjectID = $_GET['projectID'];
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
            // $studentId3 = $row['studentId3'];
            $svID = $row['svID'];
            $imgDir = $row['imgDir'];
            $abstract = $row['abstract'];
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
    $projectName = $_POST['POT'];
    $description = $_POST['description'];
    $projectType = $_POST['TOP'];
    $year = $_POST['year'];
    $department = $_POST['department'];
    $major = $_POST['major'];
    $abstract = $_POST['abstract'];

    if ($_POST['studentId1'] === "") {
        $studentId1 = 'NULL';
    } else {
        $studentId1 = $_POST['studentId1'];
    }

    if ($_POST['studentId2'] === "") {
        $studentId2 = 'NULL';
    } else {
        $studentId2 = $_POST['studentId2'];
    }

    //if ($_POST['studentId3'] === "") {
    //    $studentId3 = 'NULL';
    // } else {
    //     $studentId3 = $_POST['studentId3'];
    // }

    $svID = $_POST['svID'];
    //img upload
    $imgFile = $_FILES['poster']['name'];
    $tmp_dir = $_FILES['poster']['tmp_name'];
    $imgSize = $_FILES['poster']['size'];
    $imgDir = 'img/';
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $validExt = array('jpeg', 'jpg', 'png');
    $cImg = rand(1000, 1000000) . "." . $imgExt;

    //move img from tmp to dir
    if (in_array($imgExt, $validExt)) {
        move_uploaded_file($tmp_dir, $imgDir . $cImg);
    } else {
        $errorMsg = "<script>alert ('Sorry, please upload JPG, JPEG and PNG files only') </script>";
        echo $errorMsg;
    }

    //pdf files
    $pdfFile = $_FILES['summary']['name'];
    $tmpDirPdf = $_FILES['summary']['tmp_name'];
    $pdfSize = $_FILES['summary']['size'];
    $pdfDir = 'files/';
    $pdfExt = strtolower(pathinfo($pdfFile, PATHINFO_EXTENSION));
    $validPdfExt = array('pdf');
    $cPdf = rand(1000, 1000000) . "." . $pdfExt;

    //move img from tmp to dir
    if (in_array($pdfExt, $validPdfExt)) {
        move_uploaded_file($tmpDirPdf, $pdfDir . $cPdf);
    } else {
        $errorMsg = "<script>alert ('Sorry, please upload PDF files only') </script>";
        echo $errorMsg;
    }


    //tak ada $errorMsg proceed upload ke db
    $sqlAdd = (mysqli_query($con, "UPDATE `project` SET `projectName`='$projectName',`description`='$description',`projectType`='$projectType',`year`='$year',`department`='$department',`major`='$major',`studentId1`= $studentId1,`studentId2`=$studentId2,`svID`='$svID',`abstract`='$abstract', `imgDir`='$cImg',`fileDir`= '$cPdf' WHERE `projectID` = '$pID'"));
    if (!isset($error)) {
        $gProjectID = $pID;
        echo "<script>alert ('New record successfully inserted!') </script>";
        echo "<script>window.location.assign('manage-project.php?view=BIT)</script>";
    } else {
        echo "<script>alert ('Error occured while uploading your project') </script>";
    }
}




?>
<!DOCTYPE html>
<html>
<title>Edit Project</title>
<style>
    p {
        text-align: left;
    }
</style>

<body>


    <br>
    <div class="container">
        <div class="w3-center" id="contact">

            <h3 class="w3-center">Update Project</h3>
            <div style="margin-top:4px" class="w3-center">


                <form action="" method="POST" enctype="multipart/form-data" class="w3-center" style="width:40%;">

                    <input class="w3-input w3-border" type="text" size="40" value="<?php echo $gProjectID; ?>" required disabled>
                    <!-- <input class="w3-input w3-border" type="text" size="40" value="<?php echo $gProjectID; ?>" name="userIDs" id="userIDs" required hidden='True'></p> -->



                    <p><strong>Student 1 Name</strong><select class="w3-input w3-border" id="studentId1" name="studentId1" require>
                            <option value="<?php echo $studentId1; ?>"><?php echo $nameStudent1; ?></option>
                            <?php
                            $srchId1 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'student'");
                            while ($row = mysqli_fetch_array($srchId1)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </p>

                    <p><strong>Student 2 Name</strong><select class="w3-input w3-border" id="studentId2" name="studentId2">
                            <option value="<?php if ($studentId2 == "") {
                                                echo "";
                                            } else {
                                                echo $studentId2;
                                            } ?>"><?php if ($studentId2 == "") {
                                                        echo "Please Select";
                                                    } else {
                                                        echo $nameStudent2;
                                                    } ?></option>
                            <?php
                            $srchId2 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'student'");
                            while ($row = mysqli_fetch_array($srchId2)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="">Remove Student</option>
                        </select></p>

                    <!-- <p><strong>Student 3 Name</strong><select class="w3-input w3-border" id="studentId3" name="studentId3">
                            <option value="<?php if ($studentId3 == "") {
                                                echo "";
                                            } else {
                                                echo $studentId3;
                                            } ?>"><?php if ($studentId3 == "") {
                                                        echo "Please Select";
                                                    } else {
                                                        echo $nameStudent3;
                                                    } ?></option> 
                            <?php
                            $srchId3 = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'student'");
                            while ($row = mysqli_fetch_array($srchId3)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="">Remove Student</option>
                        </select> -->

                    <p><strong>Supervisor Name </strong><select class="w3-input w3-border" id="studentId1" name="svID">
                            <option value="<?php echo $svID ?>"><?php echo $nameSv; ?></option>
                            <?php
                            $srchSv = mysqli_query($con, "SELECT * FROM `user` WHERE type = 'lecturer'");
                            while ($row = mysqli_fetch_array($srchSv)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select></p>

                    <p><strong>Course</strong><select class="w3-input w3-border" id="department" name="department"> /* sama dgn department kut */
                            <option value="<?php echo $department; ?>"><?php if ($department == "BIT") {
                                                                            echo "Bachelor in Information Technology (BIT)";
                                                                        } else {
                                                                            echo "Bachelor of Computer Science (BCS)";
                                                                        } ?></option>
                            <option value="BIT">Bachelor in Information Technology (BIT)</option>
                            <option value="BCS">Bachelor of Computer Science (BCS)</option>
                        </select></p>

                    <p><strong>Course Code</strong><select class="w3-input w3-border" id="major" name="major">
                            <option value="<?php echo $major; ?>"><?php if ($major == "INFO4993") {
                                                                        echo "Final Year Project 1 - Bachelor in Information Technology (BIT)";
                                                                    } elseif ($major == "CSC4993") {
                                                                        echo "Final Year Project 1 - Bachelor of Computer Science (BCS)";
                                                                    } elseif ($major == "INFO4994") {
                                                                        echo "Final Year Project 2 - Bachelor in Information Technology (BIT)";
                                                                    } elseif ($major == "CSC4994") {
                                                                        echo "Final Year Project 2 - Bachelor of Computer Science (BCS)";
                                                                    } else {
                                                                        echo "Please Select";
                                                                    } ?></option>
                            <option value="INFO4993">Final Year Project 1 - Bachelor in Information Technology (BIT)</option>
                            <option value="CSC4993">Final Year Project 1 - Bachelor of Computer Science (BCS)</option>
                            <option value="INFO4994">Final Year Project 2 - Bachelor in Information Technology (BIT)</option>
                            <option value="CSC4994">Final Year Project 2 - Bachelor of Computer Science (BCS)</option>
                        </select></p>

                    <p><strong>Project Title</strong><input class="w3-input w3-border" type="text" size="50" name="POT" value="<?php echo $projectName; ?>"></p>

                    <p><strong>Project Type</strong><select class="w3-input w3-border" id="TOP" name="TOP">
                            <option value="<?php echo $projectType; ?>"><?php echo $projectType; ?></option>
                            <option value="System Development">System Development</option>
                            <option value="Multimedia">Multimedia Project</option>
                            <option value="Research">Research</option>
                        </select></p>

                    <p><strong>Year</strong>
                        <select class="w3-input w3-border" id="year" name="year">
                            <option value="<?php echo $year ?>"><?php echo $year; ?></option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2023">2024</option>
                        </select>
                    </p>
                    <p><strong>Awards</strong><input class="w3-input w3-border" type="text" size="50" name="abstract" value="<?php echo $abstract; ?>"></p>
                    <p><strong>Introduction</strong><textarea class="w3-input w3-border" name="description" id="description" cols="50" rows="10" maxlength="3000"><?php echo $description; ?></textarea></p>

                    <p>
                    <div class="w3-container ">
                        <!-- <img src="img/<?php echo $imgDir; ?>" style="width:40% ; background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  border: 5px solid #ddd;"> -->
                        </p>
                        <p><strong>Project Poster</strong><input class="w3-input w3-border " type="file" size="50" name="poster" id="poster"></p>
                        <p><strong>Project Summary</strong><input class="w3-input w3-border" type="file" size="50" name="summary" id="summary"></p>

                        </br>




                        <input class="w3-button w3-black w3-center" type="submit" value="Edit" name="Edit"></br></br>


                </form>

            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>