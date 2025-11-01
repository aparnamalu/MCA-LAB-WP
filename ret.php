<html>
<head>
    <title>Employee Registration & Display</title>
</head>
<body>
    <h2 align="center">Employee Registration Form</h2>
    <form method="POST" action="#">
        <center>
            Enter ID: <input type="text" name="eid" required><br><br>
            Enter Name: <input type="text" name="ename" required><br><br>
            Enter Department: <input type="text" name="dept" required><br><br>
            Enter Salary: <input type="text" name="sal" required><br><br>
            <input type="submit" name="submit" value="Submit">
        </center>
    </form>

    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empdb";
    $tbname = "emp";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("<br><center><b>Connection failed:</b> " . mysqli_connect_error() . "</center>");
    }

    
    if (isset($_POST['submit'])) {
        $id = $_POST['eid'];
        $name = $_POST['ename'];
        $dep = $_POST['dept'];
        $salary = $_POST['sal'];

        $query = "INSERT INTO $tbname (eid, ename, dept, sal)
                  VALUES ('$id', '$name', '$dep', '$salary')";
        $res = mysqli_query($conn, $query);

        if ($res) {
            echo "<center><b>Record Submitted Successfully!</b></center><br>";
        } else {
            echo "<center><b>Error inserting record:</b> " . mysqli_error($conn) . "</center><br>";
        }
    }

    
    $sql = "SELECT * FROM $tbname";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        echo "<h2 align='center'>Employee Details</h2>";
        echo "<table border='2' align='center' cellpadding='10'>";
        echo "<tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Salary</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>{$row['eid']}</td>
                    <td>{$row['ename']}</td>
                    <td>{$row['dept']}</td>
                    <td>{$row['sal']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<center>No employee records found.</center>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
