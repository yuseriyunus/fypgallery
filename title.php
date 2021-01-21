<?php
include "db.php";
require 'navbar.php';

?>
<!DOCTYPE html>
<html>
<title>Available Title</title>

<body>

  <div class="w3-container" style="padding:80px 45px" id="about">
    &nbsp
    <h3 class="w3-center ">Available Title</h3>
    <p class="w3-center w3-large">Discover various project title that being proposed by KICT lecturer.</p>
    <div id="bitlecturers" style="overflow-x:auto;">
      <table>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Project Domain</th>
          <th>Project Type</th>
          <th>Course</th>
          <th>Contact Person</th>
          <th> </th>
        </tr>
        <?php
        $getAvaiProject = "SELECT * FROM availabletitle INNER JOIN user ON availabletitle.svID= user.id";
        $resAvaiProject = $con->query($getAvaiProject);
        if ($resAvaiProject->num_rows > 0) {
          while ($rowBit = $resAvaiProject->fetch_assoc()) {
            $title = $rowBit['title'];
            $description = $rowBit['description'];
            $projectType = $rowBit['projectType'];
            $projectCategory = $rowBit['projectCategory'];
            $svName = $rowBit['name'];
            $svID = $rowBit['svID'];
            $email = $rowBit['email'];
            $projectDepartment = $rowBit['project'];
        ?>
            <tr>
              <td><?php echo $title; ?></td>
              <td><?php echo $description; ?></td>
              <td><?php echo $projectType; ?></td>
              <td><?php echo $projectCategory; ?></td>
              <td><?php echo $projectDepartment; ?></td>
              <td><?php echo $svName; ?></br><?php echo $email; ?></td>
              <!-- <td><a href="booking.php?id=<?php echo $svID; ?>" class="w3-button w3-teal" type="button" value="Book Consultation">Book Consultation</a></td> -->
              <td><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $email; ?>&su='Project Consultation'&body=" target="_blank" class="w3-button w3-teal"><i class="fa fa-phone-square w3-margin-right"></i>Contact Creator</a></td>
            </tr>
          <?php

          }
        } else {
          ?>
        <?php
        }
        ?>

      </table>

    </div>
  </div>
  </div>

</body>

<?php include 'footer.php'; ?>

</html>