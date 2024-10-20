<?php
    // Database connection parameters
    $host = "localhost";
    $db_user = "root";
    $db_pass = "root";
    $db_name = "dbs";

    // Establish the database connection
    $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $number = $_POST["number"];
        $action = $_POST["action"];

        switch ($action) {
            case "Insert":
                $insertSQL = "INSERT INTO college (name, p_no) VALUES ('$name', '$number')";
                $insertResult = mysqli_query($conn, $insertSQL);
                echo $insertResult ? "<p>Record inserted successfully!</p>" : "<p>Insertion failed.</p>";
                break;

            case "Update":
                $updateSQL = "UPDATE college SET p_no = '$number' WHERE name = '$name'";
                $updateResult = mysqli_query($conn, $updateSQL);
                echo $updateResult ? "<p>Record updated successfully!</p>" : "<p>Update failed.</p>";
                break;

            case "Delete":
                $deleteSQL = "DELETE FROM college WHERE p_no = '$number'";
                $deleteResult = mysqli_query($conn, $deleteSQL);
                echo $deleteResult ? "<p>Record deleted successfully!</p>" : "<p>Deletion failed.</p>";
                break;

            case "Show":
                $selectSQL = "SELECT * FROM college";
                $selectResult = mysqli_query($conn, $selectSQL);
                if ($selectResult && mysqli_num_rows($selectResult) > 0) {
                    echo "<table><tr><th>Name</th><th>Phone Number</th></tr>";
                    while ($row = mysqli_fetch_assoc($selectResult)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['p_no'] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No records found.</p>";
                }
                break;

            default:
                echo "<p>Invalid action.</p>";
                break;
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>