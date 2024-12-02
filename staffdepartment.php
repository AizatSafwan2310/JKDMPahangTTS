<?php
// No database connection is required for this page, as it is purely a static page displaying staff containers.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Containers</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
            <a href="JKDMAdminDashboard.php">BACK</a>
        </nav>
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

        h2 {
            text-align: center;
            color: #fff;
        }

        .container {
            margin: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: scale(1.05);
        }

        .container h3 {
            font-size: 24px;
            color: #192841;
            margin-bottom: 10px;
        }

        .container p {
            font-size: 18px;
            color: #444;
        }

        .container a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .container a:hover {
            background-color: #45a049;
        }

        .container-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }
    </style>
</head>
<body>
    <h2>Staff Containers</h2>
    <div class="container-list">
        <!-- KPSM Container -->
        <div class="container">
            <h3>KPSM</h3>
            <p>Here are the list of employee from KPSM's Department.</p>
            <a href="kpsmstaff.php">View Details</a>
        </div>

        <!-- PERTEK Container -->
        <div class="container">
            <h3>PERTEK</h3>
            <p>Here are the list of employee from PERTEK's Department.</p>
            <a href="pertekstaff.php">View Details</a>
        </div>

        <!-- CDN Container -->
        <div class="container">
            <h3>CDN</h3>
            <p>Here are the list of employee from CDN's Department.</p>
            <a href="cdnstaff.php">View Details</a>
        </div>

        <!-- PERKASTAMAN Container -->
        <div class="container">
            <h3>PERKASTAMAN</h3>
            <p>Here are the list of employee from Perkastaman's Department.</p>
            <a href="perkastamanstaff.php">View Details</a>
        </div>

        <!-- ZPBPK Container -->
        <div class="container">
            <h3>ZPBPK</h3>
            <p>Here are the list of employee from ZPBPK's Department.</p>
            <a href="zpbpkstaff.php">View Details</a>
        </div>

        <!-- LTSAS Container -->
        <div class="container">
            <h3>LTSAS</h3>
            <p>Here are the list of employee from LTSAS's Department.</p>
            <a href="ltsasstaff.php">View Details</a>
        </div>

        <!-- PENGUATKUASAAN Container -->
        <div class="container">
            <h3>PENGUATKUASAAN</h3>
            <p>Here are the list of employee from Penguatkuasaan's Department.</p>
            <a href="penguatkuasaanstaff.php">View Details</a>
        </div>

        <!-- PEMATUHAN Container -->
        <div class="container">
            <h3>PEMATUHAN</h3>
            <p>Here are the list of employee from Pematuhan's Department.</p>
            <a href="pematuhanstaff.php">View Details</a>
        </div>

        <!-- BENTONG Container -->
        <div class="container">
            <h3>BENTONG</h3>
            <p>Here are the list of employee from Bentong's Department.</p>
            <a href="bentongstaff.php">View Details</a>
        </div>

        <!-- CAMERON HIGHLANDS Container -->
        <div class="container">
            <h3>CAMERON HIGHLANDS</h3>
            <p>Here are the list of employee from Cameron Highland's Department.</p>
            <a href="cameronhighlandsstaff.php">View Details</a>
        </div>

        <!-- TEMERLOH Container -->
        <div class="container">
            <h3>TEMERLOH</h3>
            <p>Here are the list of employee from Temerloh's Department.</p>
            <a href="temerlohstaff.php">View Details</a>
        </div>

        <!-- PULAU TIOMAN/ROMPIN/TG. GEMOK Container -->
        <div class="container">
            <h3>PULAU TIOMAN/ROMPIN/TG.GEMOK</h3>
            <p>Here are the list of employee from Pulau Tioman/Ropmin/Tg. Gemok's Department.</p>
            <a href="PulauTiomanRompinTGstaff.php">View Details</a>
        </div>
    </div>
</body>
</html>
