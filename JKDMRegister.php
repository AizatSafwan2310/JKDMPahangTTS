<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $workposition = $_POST['workposition'];
    $icnumber = $_POST['icnumber'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];
    $password = $_POST['password'];

    $dbHost = "localhost";
    $dbName = "jkdm";
    $dbUser = "root";
    $dbPassword = ""; 
    $dbPort = "3307"; 

    if (!empty($firstName) && !empty($lastName) && !empty($workposition) &&
        !empty($icnumber) && !empty($email) && !empty($phoneNumber) &&
        !empty($address) && !empty($branch) && !empty($department) &&
        !empty($password)) {

        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/', $password)) {
            try {
                // Establishing a connection to the database
                $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare and execute the SQL statement
                $stmt = $pdo->prepare("INSERT INTO jkdmregister 
                    (firstName, lastName, workposition, icnumber, email, phoneNumber, address, branch, department, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$firstName, $lastName, $workposition, $icnumber, $email, $phoneNumber, $address, $branch, $department, $password]);

                // If the query is successful, redirect to login page
                if ($stmt->rowCount() > 0) {
                    echo "<p>Registration successful!</p>";
                    header("Location: JKDMLogin.php");
                    exit();
                } else {
                    echo "<p>Failed to register. Please try again.</p>";
                }
            } catch (PDOException $e) {
                // Handle PDO exceptions
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p>Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</p>";
        }
    } else {
        echo "<p>All fields are required!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JKDM Registration Page</title>
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
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 500px;
            margin: 80px auto;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input, button {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .footer {
            background-color: #192841;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
            <a href="JKDMLogin.php">LOG IN</a>
        </nav>
    </div>

    <div class="container">
        <h2>JKDM Pahang Registration Page</h2>
        <form action="" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="workposition">Position:</label>
            <input type="text" id="workposition" name="workposition" required>

            <label for="icnumber">IC Number:</label>
            <input type="text" id="icnumber" name="icnumber" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" required>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </div>

    <div class="footer">
        &copy; 2024 JKDM PAHANG RESERVED RIGHTS.
    </div>
</body>
</html>
