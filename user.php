<?php
require 'db.php';
include 'navbarauth.php';
session_start();
if (!isset($_SESSION['mysesi']) && !isset($_SESSION['id'])) {
    echo "<script>window.location.assign('login-student.php')</script>";
}
if (isset($_GET['view'])) {
    $list = $_GET['view'];
}


if (isset($_GET['deleteStudent'])) {
    $id = $_GET['deleteStudent'];
    $sqlStudent = "DELETE FROM `user` WHERE id = '$id'";
    if (!mysqli_query($con, $sqlStudent)) {
        $view = 'student';
        $type = 'student';
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('user.php?view=student')</script>";
    } else {
        $view = 'student';
        $type = 'student';
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('user.php?view=student')</script>";
    }
}

if (isset($_GET['deleteLecturer'])) {
    $id = $_GET['deleteLecturer'];
    $sqlLecturer = "DELETE FROM `user` WHERE id = '$id'";
    if (!mysqli_query($con, $sqlLecturer)) {
        $view = 'lecturer';
        $type = 'lecturer';
        echo "<script>alert('Delete Failed!') </script>";
        echo "<script>window.location.assign('user.php?view=lecturer')</script>";
    } else {
        $view = 'lecturer';
        $type = 'lecturer';
        echo "<script>alert('Delete Successfully!')</script>";
        echo "<script>window.location.assign('user.php?view=lecturer')</script>";
    }
}







?>


<style>
    th,
    td {
        text-align: left;
        text-align: justify;
        padding: 5px;
    }

    tr:nth-child(even) {
        background-color: #ffffff;
    }
</style>



<br>

<body>
    &nbsp;
    <div class="w3-container" style="padding: 50px 16px;" id="about">
        <h3 class="w3-center ">List of <?php echo $list;  ?></h3>

        <div class="w3-dropdown-click">
            <button onclick="myFunction()" class="w3-button w3-light-grey">Select User Type <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
            <div id="Demo" class="w3-dropdown-content w3-bar-block w3-border">
                <a onclick="window.location.href='user.php?view=<?php $view = 'student';
                                                                echo $view; ?>'" class="w3-bar-item w3-button">View Student</a>
                <a onclick="window.location.href='user.php?view=<?php $view = 'lecturer';
                                                                echo $view; ?>'" class="w3-bar-item w3-button">View Lecturer</a>
            </div>
        </div>

        <?php
        if ($list == 'student') {
        ?>
            <input class="w3-button w3-right w3-light-grey" value="Add Student" onclick="window.location.href='reg-student-admin.php'" />
            <div id="user" style="overflow-x:auto;"></br>
                <table class="active" style="width:100%">
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>

                    <?php
                    $getList = "SELECT * FROM `user` WHERE `type` = 'student'";
                    $resultList = $con->query($getList);
                    if ($resultList->num_rows > 0) {
                        while ($row = $resultList->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $department = $row['department'];
                            $section = $row['sectionNo'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                    ?>
                            <tr>
                                <td><a href='edit-information.php?edit=<?php $manageId = $id;
                                                                        echo $manageId; ?>'><?php echo $id; ?></td>
                                <td><a href='edit-information.php?edit=<?php $manageId = $id;
                                                                        echo $manageId; ?>'><?php echo $name; ?></td>
                                <td><?php echo $department; ?></td>
                                <td><?php echo $section; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><a class="w3-button fa fa-wrench" value="Update " onclick="window.location.href='edit-information.php?edit=<?php $manageId = $id;
                                                                                                                                                echo $manageId;; ?>'"></td>
                                <td> <a class="fa fa-trash" style="color:red" value="Delete" onclick="confirmDelete(<?php echo $id; ?>)"></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                    <?php
                    }
                    ?>

                </table>
            </div><br>
        <?php
        }
        ?>

        <?php
        if ($list == 'lecturer') {
        ?>

            <input class="w3-button w3-right w3-light-grey" value="Add Lecturer" onclick="window.location.href='reg-lect.php'" />
            <div id="user" style="overflow-x:auto;"></br>
                <table class="active" style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th>User ID</th> -->
                            <th>Name</th>
                            <th>Department</th>
                            <th>Specialization</th>
                            <th>Room No</th>
                            <th>Section</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getList = "SELECT * FROM `user` WHERE `type` = 'Lecturer'";
                        $resultList = $con->query($getList);
                        if ($resultList->num_rows > 0) {
                            while ($row = $resultList->fetch_assoc()) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $department = $row['department'];
                                $section = $row['sectionNo'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $specialization = $row['specialization'];
                                $room = $row['roomNo'];
                        ?>
                                <tr>
                                    <!--   <td><?php echo $id; ?></td> -->
                                    <td><a href='edit-information.php?edit=<?php $manageId = $id;
                                                                            echo $manageId; ?>'><?php echo $name; ?></td>
                                    <td><?php echo $department; ?></td>
                                    <td><?php echo $specialization; ?></td>
                                    <td><?php echo $room; ?></td>
                                    <td><?php echo $section; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $phone; ?></td>
                                    <td><a class="w3-button fa fa-wrench" value="Update " onclick="window.location.href='edit-information.php?edit=<?php $manageId = $id;
                                                                                                                                                    echo $manageId;; ?>'"></td>
                                    <td><a class="fa fa-trash" style="color:red" type="button" value="Delete" onclick="confirmDelete(<?php echo $id; ?>)"></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table><br><br>

            <?php
        }
            ?>

            </div>
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


    function myFunction() {
        var x = document.getElementById("Demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

    function confirmDelete(x) {
        var answer = confirm("Delete this user?");

        if (answer) {
            window.location.href = "user.php?deleteStudent=" + x;
        } else {}
    }
</script>

<?php
include 'footer.php';
?>