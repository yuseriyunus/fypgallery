<?php
include 'db.php';
include 'navbar.php';

$result = mysqli_query($con, "SELECT * FROM `project` WHERE abstract IS NOT NULL LIMIT 4");

?>
<!DOCTYPE html>
<html>
<title>Home</title>

<body>

  <!-- Header with full-height image -->
  <header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white" style="padding:48px">
      <span class="w3-jumbo w3-hide-small">KICT 'Arshif</span><br>
      <span class="w3-xxlarge w3-hide-large w3-hide-medium">Where all the Innovation and Creativity are stored.</span><br>
      <span class="w3-large">Where all the Innovation and Creativity are stored.</span>
      <p><a href="#about" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Find out More!</a></p>
      <p><a href="login.php" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Make an Evaluation</a></p>
    </div>
  </header>
  &nbsp


  
  &nbsp
  <div class="w3-row-padding w3-grayscale" style="padding:3%">
  <h3 class="w3-center">FEATURED PROJECT</h3>
  <p class="w3-center w3-large">Discover all the previous project that has been made by KICT student.</p>


  <div class="w3-row-padding" style="margin-top:4px">
      <?php
      while ($row = mysqli_fetch_array($result)) {
      ?>

        <div class="w3-col l3 m6 w3-margin-bottom">
          <div class="w3-card" style="padding:15px 15px">
            <div class="w3-container">
              <h3><?php echo substr_replace($row['projectName'],"... ", 15); ?></h3>
              <p class="w3-opacity"><?php echo $row['projectType']; ?> , <?php echo $row['year']; ?></p>
              <?php echo substr_replace($row['description'], " ...", 20); ?>
              <p><a href="project-description.php?projectID=<?php echo $row['projectID']; ?>" class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Read More</a></button></p>
            </div>
          </div>
        </div>
      
      <?php
      }
      ?>

  </div></div>


  <div class="w3-row-padding w3-grayscale" style="padding:3%">
  <h3 class="w3-center">OUR PROJECT</h3>
  <p class="w3-center w3-large">Discover all the previous project that has been made by KICT student.</p>


    <div class="w3-col l6 m5 w3-margin-bottom">
      <div class="w3-card ">
        <div class="w3-container">
          <h3>BIT</h3>
          <p class="w3-opacity">Bachelor of Information Technology</p>
          <p>All the previous project that been create by BIT student</p>
          <p><a href="bitproject.php" class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Project BIT</a></button></p>
        </div>
      </div>
    </div>

    <div class="w3-col l6 m6 w3-margin-bottom">
      <div class="w3-card ">
        <div class="w3-container">
          <h3>BCS</h3>
          <p class="w3-opacity">Bachelor of Computer Science</p>
          <p>All the previous project that been create by BCS student</p>
          <p><a href="bcsproject.php" class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> PROJECT BCS</a></button></p>
        </div>
      </div>
    </div>
  </div>

</body>

<?php include 'footer.php'; ?>


</html>