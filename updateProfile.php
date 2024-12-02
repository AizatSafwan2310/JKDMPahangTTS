<?php
session_start();

if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName']) || !isset($_SESSION['workposition']) || 
    !isset($_SESSION['icnumber']) || !isset($_SESSION['email']) || !isset($_SESSION['phoneNumber']) || 
    !isset($_SESSION['address']) || !isset($_SESSION['branch']) || !isset($_SESSION['department'])) {
    header("Location: JKDMLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Your Profile</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
        <nav>
            <a href="javascript:history.back()">Back</a>
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
            background-color: #808080;
            color: #3a1f04;
            padding: 10px;
            text-align: center;
        }
        .header img {
            width: 30px;
            vertical-align: middle;
        }
        .header h1 {
            display: inline-block;
            margin: 0;
            padding-left: 10px;
            vertical-align: middle;
            font-family: 'Gugi', sans-serif;
            font-weight: normal;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
        }
        label {
            margin-bottom: 5px;
            display: block;
        }
        input {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Your Profile</h2>
        <form action="updateProfileAction.php" method="post">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $_SESSION['firstName']; ?>" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $_SESSION['lastName']; ?>" required>

            <label for="workposition">Work Position:</label>
            <input type="text" id="workposition" name="workposition" value="<?php echo $_SESSION['workposition']; ?>" required>

            <label for="icnumber">IC Number:</label>
            <input type="text" id="icnumber" name="icnumber" value="<?php echo $_SESSION['icnumber']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $_SESSION['phoneNumber']; ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $_SESSION['address']; ?>" required>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" value="<?php echo $_SESSION['branch']; ?>" required>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo $_SESSION['department']; ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
