<?php
session_start();

// Check if the session is active and user details are available
if (!isset($_SESSION['firstName'])) {
    header("Location: JKDMLogin.php"); // Redirect to login if session is not active
    exit;
}

// Retrieve user profile details from session
$firstName = $_SESSION['firstName'] ?? 'Guest';
$lastName = $_SESSION['lastName'] ?? 'Unknown';
$workposition = $_SESSION['workposition'] ?? 'Unknown';
$icnumber = $_SESSION['icnumber'] ?? 'Unknown';
$email = $_SESSION['email'] ?? 'Unknown';
$phoneNumber = $_SESSION['phoneNumber'] ?? 'Unknown';
$address = $_SESSION['address'] ?? 'Unknown';
$branch = $_SESSION['branch'] ?? 'Unknown';
$department = $_SESSION['department'] ?? 'Unknown';

// Determine the group based on work position
$group = "Unknown Group";
if ($workposition) {
    $pengurusanDanProfesional = ['WK54', 'WK52', 'WK44', 'WK41', 'WK48'];
    $pegawaiSokongan1 = ['N32', 'N22', 'N19', 'WK19', 'WK22', 'WK29', 'WK32', 'WK28', 'WK26'];
    $pegawaiSokongan2 = ['N11', 'H11', 'N14', 'H14'];

    if (in_array($workposition, $pengurusanDanProfesional)) {
        $group = "Pengurusan dan Profesional";
    } elseif (in_array($workposition, $pegawaiSokongan1)) {
        $group = "Pegawai Sokongan 1";
    } elseif (in_array($workposition, $pegawaiSokongan2)) {
        $group = "Pegawai Sokongan 2";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
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
            text-align: left;
            width: 420px;
            margin: 80px auto;
        }
        .container img {
            width: 130px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .container h2 {
            text-align: center;
            margin: 0;
            padding: 0;
            font-size: 24px;
            color: #333;
        }
        .profile-info {
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .profile-info label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
            <a href="JKDMDashboard.php">BACK</a>
        </nav>
    </div>

    <div class="container">
        <img src="https://i.pinimg.com/236x/a0/c4/ee/a0c4ee77b193a26a994f7bec5f8fcdb0.jpg" alt="Profile" />
        <h2>Your Profile, <?php echo htmlspecialchars($firstName); ?>!</h2>
        <div class="profile-info">
            <label>First Name:</label> <?php echo htmlspecialchars($firstName); ?><br>
            <label>Last Name:</label> <?php echo htmlspecialchars($lastName); ?><br>
            <label>Work Position:</label> <?php echo htmlspecialchars($workposition); ?><br>
            <label>Group:</label> <?php echo htmlspecialchars($group); ?><br>
            <label>IC Number:</label> <?php echo htmlspecialchars($icnumber); ?><br>
            <label>Email:</label> <?php echo htmlspecialchars($email); ?><br>
            <label>Phone Number:</label> <?php echo htmlspecialchars($phoneNumber); ?><br>
            <label>Address:</label> <?php echo htmlspecialchars($address); ?><br>
            <label>Department:</label> <?php echo htmlspecialchars($department); ?><br>
            <label>Branch:</label> <?php echo htmlspecialchars($branch); ?><br>
        </div>
        <form action="updateProfile.php" method="post">
            <input type="submit" value="Update Profile">
        </form>
    </div>
</body>
</html>
