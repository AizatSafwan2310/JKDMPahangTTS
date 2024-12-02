<?php
// Database connection details
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root";
$dbPassword = "";
$dbPort = "3307";

// Create a connection to the database
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the updated staff details from the form submission
$icnumber = $_POST['icnumber'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$workposition = $_POST['workposition'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$department = $_POST['department'];

// SQL query to update the staff details based on icnumber
$sql = "UPDATE jkdmregister SET firstName = ?, lastName = ?, workposition = ?, email = ?, phoneNumber = ?, department = ? WHERE icnumber = ?";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $firstName, $lastName, $workposition, $email, $phoneNumber, $department, $icnumber);

// Execute the query
if ($stmt->execute()) {
    $message = "Staff details updated successfully!";
} else {
    $message = "Error: Staff details could not be updated. Please try again.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=staffdepartment.php">
    <title>Process Staff Update</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://i.pinimg.com/236x/a8/da/6f/a8da6ff35c2dbd9867aad10c3a8fa81f.jpg') center center fixed;
            background-size: cover;
            margin: 0;
            overflow-x: hidden;
            position: relative;
        }

        .header {
            background-color: #192841;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .header img {
            width: 50px;
            vertical-align: middle;
        }

        .header h1 {
            display: inline-block;
            color: #FFDE21;
            margin: 0;
            padding-left: 10px;
            vertical-align: middle;
            font-family: 'Gugi', sans-serif;
        }

        .container {
            margin: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .container h2 {
            color: #192841;
        }

        .container p {
            font-size: 1.2em;
        }

        .container a {
            color: #192841;
            font-weight: bold;
            text-decoration: none;
        }

        .container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Processing Staff Update</h2>
        <p><?php echo $message; ?></p>
        <p>You will be redirected to the staff list in 3 seconds...</p>
        <a href="staffdepartment.php">Click here if you are not redirected automatically.</a>
    </div>
</body>
</html>
