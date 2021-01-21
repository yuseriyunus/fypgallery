<?php
include "db.php";
include "navbar.php";

?>
<!DOCTYPE html>
<html>

<title>Supervisor</title>


<body>

<div class="w3-container" style="padding:80px 45px" id="about">
  &nbsp
      <h3 class="w3-center">SUPERVISOR</h3>
      <p class="w3-center w3-large">Find out who is going to be your next supervisor.</p>

      <div class="w3-row-padding w3-center" style="margin-top:64px">
        <h3>BIT's Lecturers</h3>
        <div id ="bitlecturers" style="overflow-x:auto;">
          <table>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Room Number</th>
              <th>Specialization</th>
              <th>Section</th>
              <th></th>
            </tr>

            <?php
            $getBitLect = "SELECT * FROM `user` WHERE `type`= 'lecturer' AND `department` = 'BIT' ORDER BY `Specialization` DESC";
            $resultGetBitLect = $con->query($getBitLect);
            if ($resultGetBitLect->num_rows > 0) {
              while ($rowBit = $resultGetBitLect->fetch_assoc()) {
                $nameBit = $rowBit['name'];
                $emailBit = $rowBit['email'];
                $phoneBit = $rowBit['phone'];
                $roomBit = $rowBit['roomNo'];
                $specialBit = $rowBit['specialization'];
                $sectionBit = $rowBit['sectionNo'];
            ?>

                <tr>
                  <td><?php echo $nameBit; ?></td>
                  <td><?php echo $emailBit; ?></td>
                  <td><?php echo $phoneBit; ?></td>
                  <td><?php echo $roomBit; ?></td>
                  <td><?php echo $specialBit; ?></td>
                  <td><?php echo $sectionBit; ?></td>
                  <!--<td><a href="booking.php?id=<?php echo $emailBit; ?>" class="w3-button w3-teal" type="button" value="Book Consultation">Book Consultation</a></td> -->
                  <td><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $emailBit; ?>&su='FYP Supervisor Consultation'&body=" class="w3-button w3-teal" target="_blank"><i class="fa fa-phone-square w3-margin-right"></i>Contact Supervisor</a></td>
                </tr>
              <?php

              }
            } else {
              ?>
            <?php
            }
            ?>
          </table></div>

        <br><br><br>


        <h3>BCS's Lecturers</h3>
        <div id ="bitlecturers" style="overflow-x:auto;">
          <table>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Room Number</th>
              <th>Specialization</th>
              <th>Section</th>
              <th></th>
            </tr>

            <?php
            $getBCSLect = "SELECT * FROM `user` WHERE type = 'lecturer' AND department = 'BCS' ORDER BY 'Specialization' DESC";
            $resultGetBCSLect = $con->query($getBCSLect);
            if ($resultGetBCSLect->num_rows > 0) {
              while ($rowBCS = $resultGetBCSLect->fetch_assoc()) {
                $nameBCS = $rowBCS['name'];
                $emailBCS = $rowBCS['email'];
                $phoneBCS = $rowBCS['phone'];
                $roomBCS = $rowBCS['roomNo'];
                $specialBCS = $rowBCS['specialization'];
                $sectionBCS = $rowBCS['sectionNo'];
            ?>
                <tr>
                  <td><?php echo $nameBCS; ?></td>
                  <td><?php echo $emailBCS; ?></td>
                  <td><?php echo $phoneBCS; ?></td>
                  <td><?php echo $roomBCS; ?></td>
                  <td><?php echo $specialBCS; ?></td>
                  <td><?php echo $sectionBCS; ?></td>
                  <!--<td><a href="booking.php?id=<?php echo $emailBCS; ?>" class="w3-button w3-teal" type="button" value="Book Consultation">Book Consultation</a></td> -->
                  <td><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo $emailBCS; ?>&su='FYP Supervisor Consultation'&body=" target="_blank" class="w3-button w3-teal"><i class="fa fa-phone-square w3-margin-right"></i>Contact Supervisor</a></td>

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

<?php include 'footer.php';?>
</html>