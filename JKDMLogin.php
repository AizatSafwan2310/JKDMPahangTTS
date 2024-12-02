<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>JKDM Pahang Login Page</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
        <nav>
        <a href="JKDMHomepage.php">HOME</a>
    </nav>
    </div>
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
            width: 400px;
            margin: 80px auto;
        }

        .container img {
            width: 130px;
            height: auto;
            display: block;
            margin: 0 auto;
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

        .no-account p {
            font-size: 14px;
            color: #333;
        }

        .no-account a {
            color: #000435;
            text-decoration: none;
        }

        .no-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="https://i.pinimg.com/736x/e0/d6/50/e0d6500deba130c21ff7ed4d51299527.jpg" alt="Login" />
    <h2>JKDM Pahang Login Page</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $icnumber = $_POST['icnumber'];
        $password = $_POST['password'];

        if (!empty($icnumber) && !empty($password)) {
            $dbHost = "localhost";
            $dbName = "jkdm";
            $dbUser = "root";
            $dbPassword = ""; 
            $dbPort = "3307";     

            try {
                // Updated database connection with port
                $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;port=$dbPort;charset=utf8", $dbUser, $dbPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare and execute the query to check for user credentials
                $stmt = $pdo->prepare("SELECT * FROM jkdmregister WHERE icnumber = :icnumber AND password = :password");
                $stmt->bindParam(':icnumber', $icnumber);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // User found, storing session variables
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['icnumber'] = $icnumber;
                    $_SESSION['firstName'] = $user['firstName'];
                    $_SESSION['lastName'] = $user['lastName'];
                    $_SESSION['workposition'] = $user['workposition'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['phoneNumber'] = $user['phoneNumber'];
                    $_SESSION['address'] = $user['address'];
                    $_SESSION['branch'] = $user['branch'];
                    $_SESSION['department'] = $user['department'];

                    // Redirect to the dashboard
                    header("Location: JKDMDashboard.php");
                    exit;
                } else {
                    echo "<p>Invalid IC number or password.</p>";
                }
            } catch (PDOException $e) {
                // Error handling
                echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            echo "<p>Please fill in all fields.</p>";
        }
    }
    ?>

    <form action="JKDMLogin.php" method="post">
        <label for="icnumber">IC Number:</label>
        <input type="text" id="icnumber" name="icnumber" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Log In">
        <div class="no-account">
            <p>Don't have an account? <a href="JKDMRegister.php">Register here</a>.</p>
            <p>Admin can click here! <a href="JKDMAdmin.php">Admin Login</a>.</p>
        </div>
    </form>
</div>

<div class="footer">
    &copy; 2024 JKDM PAHANG RESERVED RIGHTS.
</div>
</body>
</html>
