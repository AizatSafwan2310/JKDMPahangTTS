<?php
// Database connection details
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root";
$dbPassword = ""; 
$dbPort = "3307";

// Create connection using mysqli with the correct port
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'icnumber' is provided via POST
if (isset($_POST['icnumber'])) {
    $icnumber = $_POST['icnumber'];

    // SQL query to delete the employee record based on icnumber
    $deleteSql = "DELETE FROM jkdmregister WHERE icnumber = ?";
    $stmt = $conn->prepare($deleteSql);

    // Bind the parameter to the query
    $stmt->bind_param("s", $icnumber);

    // Execute the query
    if ($stmt->execute()) {
        echo "<div class='confirmation-message'>Staff record with IC Number $icnumber has been successfully deleted.</div>";
    } else {
        echo "<div class='error-message'>Error: Could not delete staff record. Please try again later.</div>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<div class='error-message'>Error: No IC number provided!</div>";
}

// Close connection
$conn->close();

// Redirect back to the staff list after a short delay
header("Refresh: 3; url=staffdepartment.php");
exit;
?>
