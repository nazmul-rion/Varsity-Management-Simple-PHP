<?php
session_start();
$id = $_SESSION['username'];
include('connect.php');
$sql = "SELECT * FROM teacherregistration where ID = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$lname = $row['Last Name'];
$fname = $row['First Name'];
$mobile = $row['Mobile'];
$designation = $row['Designation'];
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Teacher Page</title>
</head>

<body>
    <h1>Teacher page</h1>
</body>
<div class="card" style="float: right;">
    <img src="img/teacher.png" alt="teacher" style="width: 100%;">
    <div class="container">
        <b><?php echo "Name : " .  $fname . " " .  $lname ?></b>
        <br><br>
        <?php echo "Designation : " .  $designation ?>
        <br><br>
        <?php echo "Phone : " .  $mobile ?>
        <br><br>
    </div>
</div>
<br><br>
<button onclick="myFunction('addresult')">Add Result</button>
<button onclick="myFunction('showresult')">View Result</button>

<?php
if (isset($_POST['save'])) {
    include('connect.php');
    $sid = $_POST['StudentID'];
    $ccode = $_POST['CourseCode'];
    $marks = $_POST['Marks'];
    $grade = $_POST['Grade'];
    $sql = "INSERT INTO `result` VALUES ('$sid', '$id', '$ccode','$marks','$grade')";
    if (mysqli_query($con, $sql)) {
        echo "<h1>Records inserted successfully..!</h1>";
    } else {
        echo "<ERROR: Could not able to execute $sql." . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
<div id="addresult">
    <form method="POST">
        <fieldset>
            <legend>
                <h2><b>Add Results</b></h2>
            </legend>
            <label for="StudentID"><b>Student ID:</b></label>
            <input type="text" placeholder="StudentID" name="StudentID" id="StudentID" required>
            <label for="CourseCode"><b>Course Code:</b></label>
            <input type="text" placeholder="CourseCode" name="CourseCode" id="CourseCode" required>
            <label for="Marks"><b>Marks:</b></label>
            <input type="text" placeholder="Marks" name="Marks" id="Marks" required>
            <label for="Grade"><b>Grade:</b></label>
            <input type="text" placeholder="Grade" name="Grade" id="Grade" required>
            <br><br>
            <input type="submit" class="regbtn" name="save">
        </fieldset>
    </form>
</div>




<div id="showresult" style="float: right;">
    <h1>All Result</h1>

    <?php
    include('connect.php');
    $result = mysqli_query($con, "SELECT R.SID ,St.`First Name`, St.`Last Name`, R.`Course Code`,S.`Course Name`,  R.Marks,  R.Grade FROM `result` R , `subject` S ,studentregistration St  WHERE R.TID ='$id' AND S.`Course Code`=R.`Course Code` AND St.ID = R.SID");

    echo "<table border='2'>
    <tr>
    <th>Student ID</th>
    <th>Student Name</th>
    <th>Course Code</th>
    <th>Course Name</th>
    <th>Marks</th>
    <th>Grade</th>
    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['SID'] . "</td>";
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
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

</html>