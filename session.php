<?php


session_start();

if ($_SESSION['mytype'] == "student") {
    include 'navbaruser.php';
    echo $_SESSION['mytype'];
} elseif ($_SESSION['mytype'] == "lecturer") {
    include 'navbarlecturer.php';
} elseif ($_SESSION['mytype'] == "admin") {
    include 'navbarauth.php';
} else {
    include 'navbar.php';
}
