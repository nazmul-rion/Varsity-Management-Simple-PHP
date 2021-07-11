<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_POST['save'])) {
        include('connect.php');
        $ccode = $_POST['CourseCode'];
        $cname = $_POST['CourseName'];
        $ch = $_POST['CreditHours'];
        $ctid = $_POST['CourseTeacherID'];
        $sql = "INSERT INTO `subject` VALUES ('$ccode', '$cname', '$ch','$ctid')";
        if (mysqli_query($con, $sql)) {
            echo "<h1>Records inserted successfully..!</h1>";
        } else {
            echo "<ERROR: Could not able to execute $sql." . mysqli_error($con);
        }

        mysqli_close($con);
    }
    ?>

    <form method="POST">
        <fieldset>
            <legend>
                <h2><b>Add Course Details</b></h2>
            </legend>
            <label for="CourseCode"><b>ID:</b></label>
            <input type="text" placeholder="CourseCode" name="CourseCode" id="CourseCode" required>
            <label for="CourseName"><b>Course Name:</b></label>
            <input type="text" placeholder="Course Name" name="CourseName" id="CourseName" required>
            <label for="CreditHours"><b>Credit Hours:</b></label>
            <input type="text" placeholder="Credit Hours" name="CreditHours" id="CreditHours" required>
            <label for="CourseTeacherID"><b>Course Teacher ID:</b></label>
            <input type="text" placeholder="Course Teacher ID" name="CourseTeacherID" id="CourseTeacherID" required>
            <br><br>
            <input type="submit" class="regbtn" name="save">
        </fieldset>
    </form>
    <br>
    <h1>Course Details</h1>

    <?php
    include('connect.php');
    $result = mysqli_query($con, "SELECT * FROM `subject`");

    echo "<table border='2'>
<tr>
<th>Course Code</th>
<th>Course Name</th>
<th>Credit Hours</th>
<th>Course Teacher ID</th>
</tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['Course Code'] . "</td>";
        echo "<td>" . $row['Course Name'] . "</td>";
        echo "<td>" . $row['Credit Hours'] . "</td>";
        echo "<td>" . $row['Course Teacher ID'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($con);
    ?>

</body>

</html>