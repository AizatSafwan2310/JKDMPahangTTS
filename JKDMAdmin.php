<?php
// Database connection details
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root";
$dbPassword = ""; // Replace with your actual password
$dbPort = "3307";

// Function to hash the password using SHA-256
function hashPassword($password) {
    return hash('sha256', $password);
}

// Initialize variables for messages
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Hash the entered password
    $hashedPassword = hashPassword($password);

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $sql = "SELECT * FROM jkdmadmin WHERE username = :id AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        // Check if a matching record is found
        if ($stmt->rowCount() > 0) {
            // Redirect to dashboard
            header("Location: JKDMAdminDashboard.php");
            exit; // Prevent further code execution
        } else {
            $message = "<p class='message'>Invalid username or password!</p>";
        }
    } catch (PDOException $e) {
        $message = "<p class='message'>Database error: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://i.pinimg.com/236x/6d/1b/bf/6d1bbf45e74899fde0f9033c74e877fb.jpg') center center fixed;
            background-size: contain;
            background-repeat: no-repeat;
            background-color: #A8A9AD;
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
            border-bottom: 3px solid #F7C300;
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
            font-weight: normal;
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

        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
            margin: 80px auto;
        }

        .login-container img {
            width: 130px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            font-size: 14px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
            <a href="JKDMHomepage.php">HOME</a>
        </nav>
    </div>
    <div class="login-container">
        <img src="https://i.pinimg.com/736x/e0/d6/50/e0d6500deba130c21ff7ed4d51299527.jpg" alt="AdminLogin" />
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <label for="id">Admin ID:</label>
            <input type="text" id="id" name="id" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <?= $message; ?>
    </div>
</body>
</html>
