<?php
session_start();

// Check if the session is set and contains necessary information
if (!isset($_SESSION['firstName']) || !isset($_SESSION['icnumber'])) {
    // Redirect to login page if session info is missing
    header("Location: JKDMLogin.php");
    exit();
}

// Retrieve session data
$firstName = $_SESSION['firstName'];
$icnumber = $_SESSION['icnumber'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Update</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
        <nav>
            <a href="JKDMDashboard.php">BACK</a>
        </nav>
    </div>
    <style>
         body {
            font-family: Arial, sans-serif;
            background: url('https://i.pinimg.com/736x/e8/bb/c3/e8bbc31257dc0aa88f2b6a8c55daa1a9.jpg') center center fixed;
            background-size: cover;
            margin: 0;
            overflow-x: hidden;
            position: relative;
        }
        .header {
            background-color: #192841;
            padding: 10px;
            display: flex;
            justify-content: space-between;
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
            font-family: 'Gugi', sans-serif; /* Use Gugi font */
            font-weight: normal; /* Make the text unbold */
        }
        nav {
            display: flex;
            justify-content: flex-end;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
        } 
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: left;
            width: 400px; /* Set your desired width */
            margin: 80px auto; /* Center the container */
        }
        .profile-info {
            line-height: 1.6; /* Add space between lines */
            margin-bottom: 10px; /* Add space between sections */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Your Course</h2>
        <div class="profile-info">
            <?php
            // Check if user session is valid
            if (isset($firstName) && isset($icnumber)) {
                // Display the course update form with session data
                echo '<form action="submitCourseUpdate.php" method="post">';
                echo 'Course Name: <input type="text" name="courseName" required><br>';
                echo 'Credit Hours: <input type="text" name="creditHours" required><br>';
                echo 'Start Date: <input type="date" name="startDate" required><br>';
                echo 'End Date: <input type="date" name="endDate" required><br>';
                echo 'Location: <input type="text" name="location" required><br>';
                echo '<input type="hidden" name="firstName" value="' . htmlspecialchars($firstName) . '">';
                echo '<input type="hidden" name="icnumber" value="' . htmlspecialchars($icnumber) . '">';
                echo '<input type="submit" value="Submit">';
                echo '</form>';
            } else {
                // If session info is missing, display an error message
                echo "Error: User information is missing.";
            }
            ?>
        </div>
    </div>
</body>
</html>
