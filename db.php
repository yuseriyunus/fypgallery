<?php

$con = mysqli_connect("localhost", "root", "", "fypgallery");

if (mysqli_connect_errno()) {
    echo 'Database not found!';
}
