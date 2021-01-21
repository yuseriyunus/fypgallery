<?php
require 'db.php';
require 'navbar.php';
include 'session.php';
//session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('login-student.php')</script>";
}
if (isset($_GET['view'])) {
    $list = $_GET['view'];
}

if (isset($_GET['manage'])) {
    $projectID = $_GET['manage'];
    $srch = mysqli_query($con, "SELECT * FROM `project` WHERE id = $projectID");
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
            $studentId3 = $row['studentId3'];
            $svID = $row['svID'];
            $imgDir = $row['imgDir'];
            $abstract = $row['abstract'];
        }
    }
}

if (isset($_GET['deleteProjectbit'])) {
    $projectID = $_GET['deleteProjectbit'];
    $sqlbit = "DELETE FROM `project` WHERE projectID = '$projectID'";
    if (!mysqli_query($con, $sqlbit)) {
        $view = 'BIT';
        $type = 'BIT';
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('manage-project.php?view=BIT')</script>";
    } else {
        $view = 'BIT';
        $type = 'BIT';
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('manage-project.php?view=BIT')</script>";
    }
}


?>

<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Manage Project</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

&nbsp;
<div class="w3-container" style="padding: 50px 16px;" id="about">
    <h3 class="w3-center ">List of  <?php echo $list;  ?> Project</h3>


    <div class="w3-dropdown-click">
        <button onclick="myFunction()" class="w3-button w3-light-grey"> Select Project Department <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
        <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">
            <a onclick="window.location.href='manage-project.php?view=<?php $view = 'BIT';
                                                                        echo $view; ?>'" class="w3-bar-item w3-button">View Project BIT</a>
            <a onclick="window.location.href='manage-project.php?view=<?php $view = 'BCS';
                                                                        echo $view; ?>'" class="w3-bar-item w3-button">View Project BCS</a>


        </div>

    </div>
    <input class="w3-button w3-right w3-light-grey" value="Add Project" onclick="window.location.href='repo-project-admin.php'" />

    </br></br>

    <?php
    if ($list == 'BIT') {
    ?>
        <table class="active" style="width:100%" id="user" style="overflow-x:auto;">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Year</th>
                    <th>Major</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `project` WHERE `department` = 'BIT'";
                $resultList = $con->query($getList);
                if ($resultList->num_rows > 0) {
                    while ($row = $resultList->fetch_assoc()) {
                        $projectID = $row['projectID'];
                        $projectName = $row['projectName'];
                        $projectType = $row['projectType'];
                        $year = $row['year'];
                        $major = $row['major'];
                        $svID = $row['svID'];
                ?>
                        <tr>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectID; ?></td>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectName; ?></td>
                            <td><?php echo $projectType; ?></td>
                            <td><?php echo $year; ?></td>
                            <td><?php echo $major; ?></td>
                            <td><a class="w3-button fa fa-wrench" value="Edit " onclick="window.location.href='edit-project.php?projectID=<?php echo $projectID; ?>'"></a></td>
                            <td><a class="w3-button fa fa-trash" style="color:red" value="Delete" onclick="confirmDelete(<?php echo $projectID; ?>)"></a></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                <?php
                }
                ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table><br>
    <?php
    }
    ?>

    <?php
    if ($list == 'BCS') {
    ?>
        <table class="active" style="width:100%" id="user">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Year</th>
                    <th>Major</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `project` WHERE `department` = 'BCS'";
                $resultList = $con->query($getList);
                if ($resultList->num_rows > 0) {
                    while ($row = $resultList->fetch_assoc()) {
                        $projectID = $row['projectID'];
                        $projectName = $row['projectName'];
                        $projectType = $row['projectType'];
                        $year = $row['year'];
                        $major = $row['major'];
                        $svID = $row['svID'];
                ?>
                        <tr>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectID; ?></td>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectName; ?></td>
                            <td><?php echo $projectType; ?></td>
                            <td><?php echo $year; ?></td>
                            <td><?php echo $major; ?></td>
                            <td><a class="w3-button fa fa-wrench" value="Modify " onclick="window.location.href='edit-project.php?projectID=<?php echo $projectID; ?>'"></td>
                            <td><a class="fa fa-trash" style="color:red" aria-hidden="true" value="Delete" onclick="confirmDelete(<?php echo $projectID; ?>)"></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                <?php
                }
                ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table><br><br>
    <?php
    }
    ?>
</div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#vehicle').DataTable();
    });
    $(document).ready(function() {
        $('#example').DataTable();
        $('#user').DataTable();



    });

    function confirmDelete(x) {
        var answer = confirm("Delete this project?");

        if (answer) {
            window.location.href = "manage-project.php?deleteProjectbit=" + x;
        } else {}
    }


    function myFunction() {
        var x = document.getElementById("Demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

<?php
include 'footer.php';
?>