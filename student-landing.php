<?php
require 'db.php';
include 'navbaruser.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
  echo "<script>window.location.assign('index.php')</script>";
} else {
  $sessionId = $_SESSION['mysesi'];
}


$sqls = "SELECT * FROM `project` WHERE `studentId1` = '$sessionId' || `studentId2` = '$sessionId' || `studentId3` = '$sessionId' ";
$result = mysqli_query($con, $sqls);
while ($row = mysqli_fetch_assoc($result)) {
  $projectId = $row['projectID'];
}

$sqls = "SELECT * FROM `user` WHERE `id` = '$sessionId' || `id` = '$sessionId' || `id` = '$sessionId' ";
$result = mysqli_query($con, $sqls);
while ($row = mysqli_fetch_assoc($result)) {
  $sname = $row['name'];
}

?>


<style>
table {
    border-collapse: collapse;
    width: 100%;
    border: 2px solid grey;
    margin-left: auto;
    margin-right: auto;

  }

  th,
  td {
    text-align: left;
    padding: 6px;
  }

  th {
    background-color: #ffffff;
    color: black;
    border-bottom: double;

  }

  tr:nth-child(even) {
    background-color: #f1f1f1;
  }

form{
  margin: auto;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
    </style>



<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Evaluate Details</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body>
<div class="w3-container" style="padding:31px" id="about">

<div class="w3-container" style="padding: 50px ;" id="about">
<p class="w3-center w3-large">Welcome <br><?php echo $sname ?> </p>
        <table class="active" style="width:100%" id="user">
            <h3 class="w3-center ">Your Project</h3>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Title</th>
                    <th>Project Tyoe</th>
                    <th>Supervisor Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `project` where studentId1 = '$sessionId' OR studentId2 = '$sessionId'";
                $resultList = $con->query($getList);
                if ($resultList->num_rows > 0) {
                    while ($row = $resultList->fetch_assoc()) {
                        $projectID = $row['projectID'];
                        $projectName = $row['projectName'];
                        $projectType = $row['projectType'];
                        $year = $row['year'];
                        $major = $row['major'];
                        $studentId1 = $row['studentId1'];
                        $studentId2 = $row['studentId2'];
                        $svID = $row['svID'];
                ?>
                        <tr>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectID; ?></td>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectName; ?></td>
                            <td><?php echo $projectType; ?></td>
                            <td>
                            <?php $sql6 = "SELECT * FROM `user` WHERE id = '$svID'";
                            $resultSql6 = mysqli_query($con, $sql6);
                            while ($row = mysqli_fetch_assoc($resultSql6)) {
                                $svID = $row['name'];
                            }
                            echo $svID ?> 
                            
                            
                            
                            </td>
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
        </table><br></div>





<div class="w3-container" style="padding: 30px ;" id="about">
      <div class="w3-col l6 m5 w3-margin-bottom">
        <div class="w3-card">
          <div class="w3-container">
            <h3>Upload Your Project</h3>
            <p class="w3-opacity">Please fill all information in the form provided</p>
            <p>Project the has been submitted can be view in your profile</p>
            <p><a href="repo-project.php" class="w3-button w3-light-grey w3-block"><i class="fa fa-upload"></i> Upload</a></button></p>
          </div>
        </div>
      </div>

      <div class="w3-col l6 m6 w3-margin-bottom">
        <div class="w3-card">
          <div class="w3-container">
            <h3>Edit Your Project</h3>
            <p class="w3-opacity">Edit Your Project</p>
            <p>Please update your information in the form provided</p>
            <p><a href="edit-project.php?projectID=<?php echo $projectId; ?>" class="w3-button w3-light-grey w3-block"><i class="fa fa-wrench"></i> Update</a></button></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>


<?php include 'footer.php'; ?>