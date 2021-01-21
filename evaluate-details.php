<?php

include 'db.php';
include 'session.php';

if (isset($_GET['finalise']) && isset($_GET['finalises'])) {
    $pid = $_GET['finalise'];
    $eid = $_GET['finalises'];
    $sql2 = "SELECT * FROM `evaluation` WHERE projectID = $pid and evaluation = $eid";
    $srch2 = mysqli_query($con, $sql2);
    if ($srch2->num_rows > 0) {
        while ($row = $srch2->fetch_assoc()) {
            $m2 = $row['mark2'];
            $m3 = $row['mark3'];
        }
        $fmark = $m2 + $m3;

        $sqlupdate = "UPDATE `evaluation` SET `totalMark` = $fmark WHERE `evaluation` = $eid";
        if (!mysqli_query($con, $sqlupdate)) {
            echo "<script>alert('Update Failed!') </script>";
            echo "<script>window.location.assign('evaluate-details.php')</script>";
        } else {
            echo "<script>alert('update Successfully!')</script>";
            echo "<script>window.location.assign('evaluate-details.php')</script>";
        }
    }
}

if (isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];
    $sqldelete = "DELETE FROM `fypgallery`.`evaluation` WHERE `evaluation`.`evaluation` = '$deleteID'";
    if (mysqli_query($con, $sqldelete)) {
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('evaluate-details.php')</script>";
    } else {
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('evaluate-details.php')</script>";
    }
}

?>
<html lang="en">

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

&nbsp;
<div class="w3-container" style="padding: 50px 16px;" id="about" style="overflow-x:auto;">
    <h3 class="w3-center ">View Score </h3>


    <table class="active" style="width:100%" id="evaluate">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Supervisor</th>
                <th>Examiner 1</th>
                <th>Examiner 2</th>
                <th>Comment</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM evaluation INNER JOIN project ON evaluation.projectID = project.projectID";
            $resultsql = $con->query($sql);
            if ($resultsql->num_rows > 0) {
                while ($row = $resultsql->fetch_assoc()) {
                    $evaID = $row['evaluation'];
                    $projectID = $row['projectID'];
                    $projectname = $row['projectName'];
                    $svID = $row['svID'];
                    $evaluator1 = $row['evaluatorID1'];
                    $evaluator2 = $row['evaluatorID2'];
                    $evaluator3 = $row['evaluatorID3'];
                    $mark1 = $row['mark1'];
                    $mark2 = $row['mark2'];
                    $mark3 = $row['mark3'];
                    $totalmark = $row['totalMark'];
                    $comment = $row['comment'];
                    $rm2 = $row['reportMark2'];
                    $rm3 = $row['reportMark3'];

            ?>

                    <tr id="<?php echo $evaID; ?>">
                        <td><?php echo $projectname; ?></td>
                        <td><?php $sql1 = "SELECT * FROM `user` WHERE id = '$svID'";
                            $resultSql1 = mysqli_query($con, $sql1);
                            while ($row = mysqli_fetch_assoc($resultSql1)) {
                                $svName = $row['name'];
                            }
                            echo $svName; ?></td>

                        <td><?php $sql4 = "SELECT * FROM `user` WHERE id = '$evaluator2'";
                            $resultSql4 = mysqli_query($con, $sql4);
                            while ($row = mysqli_fetch_assoc($resultSql4)) {
                                $evaluatorname1 = $row['name'];
                            }
                            echo $evaluatorname1 . " (" . $evaluator2 . ")"; ?> <br><br>

                            Report:   <b><?php echo $rm2?></b><br>
                            Showcase: <b><?php echo $mark2?></b></td>
                            
                            
                            
                            </td>
                            
                            <td>
                        <?php $sql5 = "SELECT * FROM `user` WHERE id = '$evaluator3'";
                             $resultSql5 = mysqli_query($con, $sql5);
                             while ($row = mysqli_fetch_assoc($resultSql5)) {
                             $evaluatorname2 = $row['name'];
                             }
                             echo $evaluatorname2 . " (" . $evaluator3 . ")"; ?> <br><br>
                            Report:   <b><?php echo $rm3?></b><br>
                            Showcase: <b><?php echo $mark3?></b></td>
                            

                        <td><?php echo $comment; ?></td>
                        <td><a class="fa fa-trash" style="color:red" aria-hidden="true" value="Delete" onclick="confirmDelete(<?php echo $evaID; ?>)"></td>
                    </tr>
                <?php
                }
            } else {
                ?>
            <?php
            }
            ?>
        </tbody>

    </table>
</div>
</body>


<?php include 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#vehicle').DataTable();
    });
    $(document).ready(function() {
        $('#example').DataTable();
        $('#evaluate').DataTable();



    });

    function confirmfinal() {
        var answer = confirm("Are you sure want to finalise mark this project (<?php echo $projectname; ?>)?");

        if (answer) {
            window.location.href = "evaluate-details.php?finalise=<?php echo $projectID; ?>&&finalises=<?php echo $evaID; ?>";
        } else {
            alert("okay")
        }
    }

    function confirmDelete(x) {
        var answer = confirm("Are you sure want to delete this project " + x + "?");

        if (answer) {
            window.location.href = "evaluate-details.php?delete=" + x;
        } else {
            alert("Project not deleted")
        }
    }
</script>

</html>