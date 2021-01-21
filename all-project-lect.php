<?php
require 'db.php';
include 'navbarlecturer.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('index.php')</script>";
} else {
    $sessionId = $_SESSION['mysesi'];
}


?>

<body>
    &nbsp;


    <div class="w3-container" style="padding: 50px 16px;" id="about">
        <table class="active" style="width:100%" id="user">
            <h3 class="w3-center ">Current Project</h3>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Project Title</th>
                    <th>Student Name</th>
                    <th>Project Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `project` where svID = '$sessionId' ";
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
                ?>
                        <tr>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectID; ?></td>
                            <td><a href='project-description-admin.php?projectID=<?php echo $row['projectID']; ?>'><?php echo $projectName; ?></td>
                            <td><?php echo $studentId1;
                                if (!is_null($studentId2)) {
                                    echo "<br>" . $studentId2;
                                } ?></p>
                            </td>
                            <td><?php echo $projectType; ?></td>
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