<?php
include 'db.php';
if (isset($_GET['file'])) {
    $filename = $_GET['file'];

    // fetch file to download from database
    $sql = "SELECT fileDir  FROM `project` WHERE `fileDir` = 'filename'";
    $result = mysqli_query($con, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'files/' . $file['name'];

    if (!empty($_GET['file'])) {
        $filename = basename($_GET['file']);
        $filepath = 'files/' . $filename;
        if (!empty($filename) && file_exists($filepath)) {

            //Define Headers
            header("Cache-Control: public");
            header("Content-Description: FIle Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/zip");
            header("Content-Transfer-Emcoding: binary");

            readfile($filepath);
            exit;
        } else {
            echo "<script>alert('File not exist!')</script>";
            echo "File not exist";
            //echo "<script>window.location.assign('project-description.php')</script>";
        }
    }
}
