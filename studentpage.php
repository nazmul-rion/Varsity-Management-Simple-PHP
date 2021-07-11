<?php
session_start();
$id = $_SESSION['username'];
include('connect.php');
$sql = "SELECT * FROM studentregistration where ID = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$lname = $row['Last Name'];
$fname = $row['First Name'];
$mobile = $row['Mobile'];
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Page</title>
</head>

<body>
    <h1>Student page</h1>
</body>
<div class="card" style="float: right;">
    <img src="img/student.jpg" alt="Student" style="width: 100%; ">
    <div class="container">
        <b><?php echo "Name : " .  $fname . " " .  $lname ?></b>
        <br><br>
        <?php echo "Phone : " .  $mobile ?>
        <br><br>
    </div>
</div>
<br>
<button onclick="myFunction()">View Result</button>
<div id="showresult" style="float: right;">

    <h1>Your Result</h1>

    <?php
    include('connect.php');
    $result = mysqli_query($con, "SELECT T.`First Name`, T.`Last Name`, R.`Course Code`,S.`Course Name`,  R.Marks,  R.Grade FROM `result` R , `subject` S ,teacherregistration T  WHERE R.SID ='$id' AND S.`Course Code`=R.`Course Code` AND T.ID = R.TID");

    echo "<table border='2'>
<tr>
<th>Course Teacher</th>
<th>Course Code</th>
<th>Course Name</th>
<th>Marks</th>
<th>Grade</th>
</tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['First Name'] . ' ' . $row['Last Name'] . "</td>";
        echo "<td>" . $row['Course Code'] . "</td>";
        echo "<td>" . $row['Course Name'] . "</td>";
        echo "<td>" . $row['Marks'] . "</td>";
        echo "<td>" . $row['Grade'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($con);
    ?>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("showresult");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

</html>