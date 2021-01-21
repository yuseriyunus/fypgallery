<?php
include 'db.php';
include 'session.php';

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
      <p><a href="evaluation.php" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Make an Evaluation</a></p>
    </div>
  </header>
  &nbsp


  <h3 class="w3-center">ABOUT THE KICT 'Arshif</h3>
  <p class="w3-center w3-medium">The FYP gallery will be able users to view the previous project,</p>
  <p class="w3-center w3-medium"> book a consultation with their supervisor-to-be, and make an evaluation directly from that system.</p>

  &nbsp
  <h3 class="w3-center">THE PROJECT</h3>
  <p class="w3-center w3-large">Discover all the previous project that has been made by KICT student.</p>

  <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
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