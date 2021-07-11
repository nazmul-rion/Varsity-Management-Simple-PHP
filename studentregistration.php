<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_POST['save'])) {
        include('connect.php');
        $id = $_POST['ID'];
        $fname = $_POST['FristName'];
        $lname = $_POST['LastName'];
        $mobile = $_POST['Mobile'];
        $pass = $_POST['Password'];
        $sql = "INSERT INTO `studentregistration`(`ID`, `First Name`, `Last Name`, `Mobile`, `Password`)  VALUES ('$id', '$fname', '$lname','$mobile','$pass')";
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
                <h2><b>Student Registration Form</b></h2>
            </legend>
            <label for="ID"><b>ID:</b></label>
            <input type="text" placeholder="ID" name="ID" id="ID" required>
            <label for="FristName"><b>Frist Name:</b></label>
            <input type="text" placeholder="Frist Name" name="FristName" id="FristName" required>
            <label for="LastName"><b>Last Name:</b></label>
            <input type="text" placeholder="Last Name" name="LastName" id="LastName" required>
            <label for="Mobile"><b>Mobile No:</b></label>
            <input type="text" placeholder="Mobile No" name="Mobile" id="Mobile" required>
            <label for="Password"><b>Password:</b></label>
            <input type="password" placeholder="Password" name="Password" id="Password" required>
            <label for="RPassword"><b>Retype Password:</b></label>
            <input type="password" placeholder="Retype Password" name="RPassword" id="RPassword" required>
            <br><br>
            <input type="submit" class="regbtn" name="save">
        </fieldset>
    </form>
    <br>
    <h1>All Student Details</h1>

    <?php
    include('connect.php');
    $result = mysqli_query($con, "SELECT * FROM `studentregistration`");

    echo "<table border='2'>
<tr>
<th>ID</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Mobile</th>
<th>Password</th>
</tr>";


    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['First Name'] . "</td>";
        echo "<td>" . $row['Last Name'] . "</td>";
        echo "<td>" . $row['Mobile'] . "</td>";
        echo "<td>" . $row['Password'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_close($con);
    ?>

</body>

</html>