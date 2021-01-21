<?php
require 'db.php';
include 'navbarauth.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('login-student.php')</script>";
}



?>

<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body>
    &nbsp;

    
    <div class="w3-container" style="padding: 50px 16px;" id="about">
        <table class="active" style="width:100%" id="user">
        <h3 class="w3-center ">Assign Examiner</h3>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Supervisor Name</th>
                    <th>Project Type</th>
                    <th>Course Code</th>
                    <th>Department</th>
                    <th>Assign Examiner</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `project` INNER JOIN user ON project.svID=user.id";
                $resultList = $con->query($getList);
                if ($resultList->num_rows > 0) {
                    while ($row = $resultList->fetch_assoc()) {
                        $projectID = $row['projectID'];
                        $projectName = $row['projectName'];
                        $svName = $row['name'];
                        $major = $row['major'];
                        $department = $row['department'];
                        $projectType = $row['projectType'];
                ?>
                        <tr>
                            <td><?php echo $projectID; ?></td>
                            <td><?php echo $projectName; ?></td>
                            <td><?php echo $svName; ?></td>
                            <td><?php echo $projectType; ?></td>
                            <td><?php echo $major; ?></td>
                            <td><?php echo $department; ?></td>
                            <td><input type="button" value="Assign" onclick="window.location.href='assign-project-lecturer.php?projectID=<?php echo $row['projectID']; ?>'" /></td>
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
</script>

<?php
include 'footer.php';
?>