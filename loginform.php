<?php
session_start();
include('connect.php');
$id = $_POST['ID'];
$pass = $_POST['Password'];
$stresult = mysqli_query($con, "SELECT * FROM studentregistration WHERE ID='$id' and Password = '$pass'");
$tchresult = mysqli_query($con, "SELECT * FROM teacherregistration WHERE ID='$id' and Password = '$pass'");

if ($id == 'admin' && $pass == 'admin') {
    $_SESSION['username'] = $id;
    header('location:adminpage.php');
} elseif (mysqli_num_rows($stresult)) {
    $_SESSION['username'] = $id;
    header('location:studentpage.php');
} elseif (mysqli_num_rows($tchresult)) {
    $_SESSION['username'] = $id;
    header('location:teacherpage.php');
} else
    echo "Unknown ID or Password...!";

mysqli_close($con);
