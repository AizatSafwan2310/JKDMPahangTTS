<?php
session_start();

if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName']) || !isset($_SESSION['workposition']) || 
    !isset($_SESSION['icnumber']) || !isset($_SESSION['email']) || !isset($_SESSION['phoneNumber']) || 
    !isset($_SESSION['address']) || !isset($_SESSION['branch']) || !isset($_SESSION['department'])) {
    header("Location: JKDMLogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $workposition = $_POST['workposition'];
    $icnumber = $_POST['icnumber'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $branch = $_POST['branch'];
    $department = $_POST['department'];

    // Database connection parameters
    $dbHost = "localhost";
    $dbName = "jkdm";
    $dbUser = "root";
    $dbPassword = ""; // Replace with your actual password
    $dbPort = "3307";

    if ($firstName && $lastName && $workposition && $icnumber && $email && $phoneNumber && $address && $branch && $department) {
        try {
            // Create connection with port
            $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Update query
            $query = "UPDATE jkdmregister SET firstName = :firstName, lastName = :lastName, workposition = :workposition, 
                      email = :email, phoneNumber = :phoneNumber, address = :address, branch = :branch, 
                      department = :department WHERE icnumber = :icnumber";

            $stmt = $pdo->prepare($query);

            // Bind parameters
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':workposition', $workposition);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':branch', $branch);
            $stmt->bindParam(':department', $department);
            $stmt->bindParam(':icnumber', $icnumber);

            // Execute update query
            $stmt->execute();

            // Update session variables
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['workposition'] = $workposition;
            $_SESSION['email'] = $email;
            $_SESSION['phoneNumber'] = $phoneNumber;
            $_SESSION['address'] = $address;
            $_SESSION['branch'] = $branch;
            $_SESSION['department'] = $department;

            echo "<p>Profile updated successfully! Redirecting...</p>";
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>All fields are required.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://i.pinimg.com/736x/e8/bb/c3/e8bbc31257dc0aa88f2b6a8c55daa1a9.jpg') center center fixed;
            background-size: cover;
            margin: 0;
            overflow-x: hidden;
            position: relative;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: 80px auto;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Profile</h2>
        <form method="POST">
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

        <script>
            setTimeout(function() {
                window.location.href = 'profile.php'; // Redirect to profile page after 3 seconds
            }, 3000);
        </script>
    </div>
</body>
</html>
