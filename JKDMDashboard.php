<?php
session_start(); // Start the session to access session variables
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h2>Jabatan Kastam Diraja Malaysia Pahang</h2>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
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
            text-align: center;
        }

        .header img {
            width: 50px;
            vertical-align: middle;
        }

        .header h2 {
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
            text-align: center;
            width: 300px; /* Set your desired width */
            margin: 80px auto; /* Center the container */
        }

        .sidebar {
            width: 0; /* Initially hidden */
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            padding-top: 20px;
            float: left;
            height: calc(100vh - 60px); /* Adjusting for header height */
            overflow: hidden; /* Hide overflowing content */
            transition: width 0.5s; /* Add transition effect */
        }

        .sidebar .nav-button {
            display: block;
            margin: 10px auto;
            width: 80%;
            padding: 10px 20px;
            background-color: rgba(128, 128, 128, 0.5); /* Grey with transparency */
            border: none;
            border-radius: 5px;
            color: white; /* Change text color to white */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            text-align: center;
        }

        .sidebar .nav-button:hover {
            background-color: #ccc;
            color: #000;
        }

        .hamburger {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 999; /* Ensure it's above other elements */
            cursor: pointer;
        }

        .hamburger .line {
            width: 30px;
            height: 3px;
            background-color: #fff;
            margin: 5px 0;
            transition: transform 0.3s, opacity 0.3s;
        }

        /* Styles for the "active" state of the hamburger icon */
        .hamburger.active .line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .hamburger.active .line:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active .line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }
    </style>
</head>
<body>
    <div class="hamburger" onclick="toggleSidebar()">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            var mainContent = document.querySelector('.main-content');
            var hamburger = document.querySelector('.hamburger');

            if (sidebar.style.width === '250px') {
                sidebar.style.width = '0';
                mainContent.style.marginLeft = '0';
                hamburger.classList.remove('active');
            } else {
                sidebar.style.width = '250px';
                mainContent.style.marginLeft = '250px';
                hamburger.classList.add('active');
            }
        }
    </script>

    <div class="sidebar">
        <button class="nav-button" onclick="location.href='profile.php'">PROFILE</button>
        <button class="nav-button" onclick="location.href='courseform.php'">COURSE UPDATE</button>
        <button class="nav-button" onclick="location.href='summary.php'">REPORT & SUMMARY</button>
        <button class="nav-button" onclick="location.href='JKDMLogout.php'">LOG OUT</button>
    </div>

    <div class="container">
        <h2>Welcome, 
            <?php
            if (isset($_SESSION['firstName'])) {
                echo htmlspecialchars($_SESSION['firstName']);
            } else {
                echo "Guest";
            }
            ?>!
        </h2>
        <p>This is your personalized dashboard.</p>
    </div>
</body>
</html>
