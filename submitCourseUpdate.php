<?php
// Redirect to the course form page after 3 seconds
header("Refresh: 3; url=courseform.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $icnumber = $_POST['icnumber'];
    $courseName = $_POST['courseName'];
    $creditHours = $_POST['creditHours'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $location = $_POST['location'];

    // Database connection parameters
    $dbHost = "localhost";
    $dbName = "jkdm";
    $dbUser = "root"; // Replace with your database username
    $dbPassword = ""; // Replace with your database password
    $dbPort = "3307"; // Update to your MySQL port if different

    try {
        // Establish database connection
        $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL query
        $sql = "INSERT INTO courses (firstName, icnumber, courseName, creditHours, startDate, endDate, location) 
                VALUES (:firstName, :icnumber, :courseName, :creditHours, :startDate, :endDate, :location)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':icnumber', $icnumber);
        $stmt->bindParam(':courseName', $courseName);
        $stmt->bindParam(':creditHours', $creditHours);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':location', $location);

        // Execute query
        if ($stmt->execute()) {
            echo "<p>Course updated successfully. Redirecting to the course form...</p>";
        } else {
            echo "<p>Failed to update the course. Redirecting to the course form...</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
