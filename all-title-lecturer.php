<?php
require 'db.php';
include 'navbarlecturer.php';


session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('index.php')</script>";
} else {
    $sessionId = $_SESSION['mysesi'];
}



if (isset($_GET['deleteTitle'])) {
    $availabeID = $_GET['deleteTitle'];
    $sqltitle = "DELETE FROM `availabletitle` WHERE availabeID = '$availabeID'";
    if (!mysqli_query($con, $sqltitle)) {
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('all-title-lecturer.php')</script>";
    } else {
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('all-title-lecturer.php')</script>";
    }
}


?>

<body>
    &nbsp;


    <div class="w3-container" style="padding: 50px 16px;" id="about">
        <table class="active" style="width:100%" id="user">
            <h3 class="w3-center ">List of Uploaded Idea</h3>
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Project Domain</th>
                    <th>Course</th>
                    <th>Project Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `availabletitle` where svID = '$sessionId' ";
                $resultList = $con->query($getList);
                if ($resultList->num_rows > 0) {
                    while ($row = $resultList->fetch_assoc()) {
                        $availabe = $row['availabeID'];
                        $projectTitle = $row['title'];
                        $projectDomain = $row['projectType'];
                        $department = $row['project'];
                        $projectType = $row['projectCategory'];
                ?>
                        <tr id="<?php echo $availabe; ?>">
                            <td><?php echo $projectTitle; ?></td>
                            <td><?php echo $projectDomain; ?></td>
                            <td><?php echo $department; ?></td>
                            <td><?php echo $projectType; ?></td>
                            <td><input type="button" class="fa fa-trash" style="color:red" aria-hidden="true" value="Delete" onclick="confirmDelete(<?php echo $availabe; ?>)"></td>
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


    function confirmDelete(x) {
        var answer = confirm("Delete this project?");

        if (answer) {
            window.location.href = "all-title-lecturer.php?deleteTitle=" + x;
        } else {}
    }
</script>

<?php
include 'footer.php';
?>