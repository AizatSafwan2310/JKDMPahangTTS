<?php
// Database connection details
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root";
$dbPassword = ""; // Replace with your actual password
$dbPort = "3307";

// Create database connection
try {
    $conn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    exit;
}

// Get the course name from the query string
$courseName = isset($_GET['courseName']) ? $_GET['courseName'] : '';

// SQL query to get the staff list for the given course
$sql = "SELECT r.firstname, r.icnumber, r.branch, r.department 
        FROM JKDMRegister r 
        INNER JOIN courses c ON r.icnumber = c.icnumber 
        WHERE c.courseName = :courseName";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':courseName', $courseName, PDO::PARAM_STR);
$stmt->execute();
$staffList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List for Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back-button {
            background-color: #FFDE21;
            color: #192841;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .back-button:hover {
            background-color: #FFD700;
        }
    </style>
</head>
<body>
<div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDM">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
        <a href="admincourse.php" class="back-button">BACK</a>
    </nav>
    </div>

    

    <h2>Staff List for Course</h2>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>IC Number</th>
                <th>Branch</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($staffList) {
                foreach ($staffList as $staff) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($staff['firstname']) . "</td>";
                    echo "<td>" . htmlspecialchars($staff['icnumber']) . "</td>";
                    echo "<td>" . htmlspecialchars($staff['branch']) . "</td>";
                    echo "<td>" . htmlspecialchars($staff['department']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No staff found for this course.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn = null;
?>
