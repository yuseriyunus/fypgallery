<?php
require 'db.php';
include 'navbarlecturer.php';

session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
  echo "<script>window.location.assign('index.php')</script>";
} else {
  $sessionId = $_SESSION['mysesi'];
}

$sqls = "SELECT * FROM `user` WHERE `id` = '$sessionId' || `id` = '$sessionId' || `id` = '$sessionId' ";
$result = mysqli_query($con, $sqls);
while ($row = mysqli_fetch_assoc($result)) {
  $sname = $row['name'];
}

?>


<html lang="en">


<body>
  <br>

  </br>

  <div class="w3-container" style="padding: 30px 20px;" id="about" style="overflow-x:auto">
  <h4 class="w3-center">Welcome <br><?php echo $sname ?> </h4>
    <b>
      <p class="w3-center w3-large">Here is your project that need to be assesst.</p>
    </b>
    <table class="active" id="user">

      <thead>
        <tr>
          <th>Project ID</th>
          <th>Project Name</th>
          <th>Report Mark</th>
          <th>Evaluate Project</th>
          <th>Overview</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $getList = "SELECT * FROM `evaluation` INNER JOIN project on evaluation.projectID = project.projectID WHERE `evaluatorID1` = '$sessionId' || `evaluatorID2` = '$sessionId' || `evaluatorID3` = '$sessionId' ";
        $resultList = $con->query($getList);
        if ($resultList->num_rows > 0) {
          while ($row = $resultList->fetch_assoc()) {
            $evaluationID = $row['evaluation'];
            $projectName = $row['projectName'];
            $projectID = $row['projectID'];
            if ($row['evaluatorID1'] == $sessionId) {
              $getMark = $row['mark1'];
            } elseif ($row['evaluatorID2'] == $sessionId) {
              $getMark = $row['mark2'];
            } elseif ($row['evaluatorID3'] == $sessionId) {
              $getMark = $row['mark3'];
            }

            if ($row['evaluatorID2'] == $sessionId) {
              $reportmark = $row['reportMark2'];
            } elseif ($row['evaluatorID3'] == $sessionId) {
              $reportmark = $row['reportMark3'];
            }


        ?>
            <tr>
              <td><?php echo $projectID; ?></td>
              <td><?php echo $projectName; ?></td>
              <td><input class="w3-button w3-teal" type="button" value="Submit" onclick="window.location.href='submit-report.php?projectID=<?php echo $evaluationID; ?>'" /></td>
              <td><input class="w3-button w3-teal " type="button" value="Submit" onclick="window.location.href='evaluate-project.php?evaluation=<?php echo $evaluationID; ?>'" /></td>
              <td>Report :<b> <?php echo $reportmark; ?></b> </br>
                  Showcase: <b><?php echo $getMark; ?></b></td>
            </tr>
          <?php
          }
        } else {
          ?>
        <?php
        }
        ?>
      </tbody>
    </table><br>
  </div>


  <h3 class="w3-center">Dashboard</h3>
  <div class="w3-row-padding w3-grayscale" style="margin-top:40px">
    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-card" style="padding:15px 15px">
        <div class="w3-container">
          <h3> Your Project</h3>
          <p class="w3-opacity"> All project under your supervision</p>
          <p><a href="all-project-lect.php" class="w3-button w3-light-grey w3-block"><i class="fa fa-clipboard"></i> View</a></button></p>
        </div>
      </div>
    </div>

    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-card" style="padding:15px 15px">
        <div class="w3-container">
          <h3> Your Title</h3>
          <p class="w3-opacity">All title uploaded</p>
          <p><a href="all-title-lecturer.php" class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> View</a></button></p>
        </div>
      </div>
    </div>


    <div class="w3-col l4 m6 w3-margin-bottom">
      <div class="w3-card" style="padding:15px 15px">
        <div class="w3-container">
          <h3>Upload Your Idea</h3>
          <p class="w3-opacity"> Click Here</p>
          <p><a href="upload-title.php" class="w3-button w3-light-grey w3-block"><i class="fa fa-lightbulb-o"></i> Add Idea</a></button></p>
        </div>
      </div>
    </div>


  </div>



</body>

</html>

<?php
include 'footer.php';
?>