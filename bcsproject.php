<?php
require 'db.php';
require 'navbar.php';

?>

<!DOCTYPE html>
<html>
<title>BCS Project</title>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body>


  <div class="w3-container" style="padding:50px 16px" id="about">
    &nbsp
    <h3 class="w3-center ">THE PROJECT</h3>
    <p class="w3-center w3-large">Discover all the previous project that has been made by BIT student.</p>

        <table class="active" style="width:100%" id="user">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Supervisor Name</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getList = "SELECT * FROM `project` INNER JOIN user ON project.svID=user.id WHERE project.department = 'BCS' AND project.major = 'CSC4994'";
                $resultList = $con->query($getList);
                if ($resultList->num_rows > 0) {
                    while ($row = $resultList->fetch_assoc()) {
                        $projectID = $row['projectID'];
                        $projectName = $row['projectName'];
                        $svName = $row['name'];
                        $projectType = $row['projectType'];
                        $year = $row['year'];
                ?>
                        <tr>
                        <td><a href='project-description.php?projectID=<?php echo $row['projectID'];  ?>'><?php echo $projectName; ?></td>
                        <td><?php echo $projectType; ?></td>
                            <td><?php echo $svName; ?></td>
                            <td><?php echo $year; ?></td>
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


  
    </div>
  </div>
</body>
<?php include 'footer.php';?>

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



