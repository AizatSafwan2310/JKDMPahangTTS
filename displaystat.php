<!DOCTYPE html>
<html>
<head>
    <title>Staff Details</title>
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
            width: 500px;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .status-pass {
            background-color: green;
            color: white;
        }
        .status-halfpass {
            background-color: yellow;
            color: black;
        }
        .status-low {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
            <a href="JKDMHomepage.php">BACK</a>
        </nav>
    </div>
    <div class="container">
        <h2>Staff Details</h2>
        <?php
        // Database connection settings
        $servername = "localhost:3307"; // Custom port
        $username = "root";
        $password = "";
        $dbname = "jkdm";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the IC number from the request
        $icnumber = isset($_GET['icnumber']) ? $_GET['icnumber'] : '';

        if (!empty($icnumber)) {
            // Fetch staff details
            $staffQuery = "SELECT * FROM jkdmregister WHERE icnumber = ?";
            $stmt = $conn->prepare($staffQuery);
            $stmt->bind_param("s", $icnumber);
            $stmt->execute();
            $staffResult = $stmt->get_result();

            if ($staffResult->num_rows > 0) {
                $staff = $staffResult->fetch_assoc();
                $firstName = $staff['firstName'];
                $lastName = $staff['lastName'];
                $workPosition = $staff['workposition'];
                $email = $staff['email'];
                $phoneNumber = $staff['phoneNumber'];
                $department = $staff['department'];
                $branch = $staff['branch'];

                // Determine the group
                $pengurusanDanProfesional = ["WK54", "WK52", "WK44", "WK41", "WK48"];
                $pegawaiSokongan1 = ["N32", "N22", "N19", "WK19", "WK22", "WK29", "WK32", "WK28", "WK26"];
                $pegawaiSokongan2 = ["N11", "H11", "N14", "H14"];

                if (in_array($workPosition, $pengurusanDanProfesional)) {
                    $group = "Pengurusan dan Profesional";
                } elseif (in_array($workPosition, $pegawaiSokongan1)) {
                    $group = "Pegawai Sokongan 1";
                } elseif (in_array($workPosition, $pegawaiSokongan2)) {
                    $group = "Pegawai Sokongan 2";
                } else {
                    $group = "Unknown Group";
                }

                // Fetch course details
                $courseQuery = "SELECT courseName, creditHours, startDate, endDate, location FROM courses WHERE icnumber = ?";
                $stmt = $conn->prepare($courseQuery);
                $stmt->bind_param("s", $icnumber);
                $stmt->execute();
                $courseResult = $stmt->get_result();

                // Calculate total credits and count of courses
                $totalCredits = 0;
                $courseCount = 0;

                while ($course = $courseResult->fetch_assoc()) {
                    $totalCredits += $course['creditHours'];
                    $courseCount++;
                }

                // Determine status
                if ($totalCredits >= 42) {
                    $status = "COMPLETED";
                    $statusClass = "status-pass";
                } elseif ($totalCredits >= 21) {
                    $status = "ALMOST COMPLETED";
                    $statusClass = "status-halfpass";
                } else {
                    $status = "BARELY COMPLETED";
                    $statusClass = "status-low";
                }

                // Display staff details
                echo "<h3>Staff Information</h3>";
                echo "<table>";
                echo "<tr><th>First Name</th><td>$firstName</td></tr>";
                echo "<tr><th>Last Name</th><td>$lastName</td></tr>";
                echo "<tr><th>Department</th><td>$department</td></tr>";
                echo "<tr><th>Branch</th><td>$branch</td></tr>";
                echo "<tr><th>Total Credits</th><td>$totalCredits</td></tr>";
                echo "<tr><th>Course Count</th><td>$courseCount</td></tr>";
                echo "<tr><th>Status</th><td class=\"$statusClass\">$status</td></tr>";
                echo "</table>";
            } else {
                echo "<p>No staff found with the provided IC number.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Please provide an IC number.</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</body>
</html>
