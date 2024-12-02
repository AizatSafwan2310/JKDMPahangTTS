<?php
session_start();

if (!isset($_SESSION['firstName']) || !isset($_SESSION['icnumber'])) {
    header("Location: JKDMLogin.php");
    exit();
}

// Database connection parameters
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root"; // Replace with your database username
$dbPassword = ""; // Replace with your database password
$dbPort = "3307"; // Update if your MySQL port is different

$firstName = $_SESSION['firstName'];
$icnumber = $_SESSION['icnumber'];

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the query
    $query = "SELECT courseName, creditHours, startDate, endDate 
              FROM courses 
              WHERE firstName = :firstName AND icnumber = :icnumber";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':icnumber', $icnumber);
    $stmt->execute();

    // Initialize summary variables
    $totalCredits = 0;
    $courseCount = 0;
    $totalDays = 0;
    $earliestStartDate = null;
    $latestEndDate = null;

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Completion Summary</title>
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
            width: 1000px;
            margin: 80px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: navy;
            color: yellow;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #e0e0e0;
        }
    </style>
    <script>
        function printSummary() {
            window.print();
        }
    </script>
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
        <h2>Course Completion Summary for, <?= htmlspecialchars($firstName) ?>!</h2>
        <table>
            <tr>
                <th>Course Name</th>
                <th>Credit Hours</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Days</th>
            </tr>
            <?php foreach ($rows as $row): 
                $courseName = $row['courseName'];
                $creditHours = (int)$row['creditHours'];
                $startDate = new DateTime($row['startDate']);
                $endDate = new DateTime($row['endDate']);
                $courseDays = $startDate->diff($endDate)->days + 1;

                // Update summary statistics
                $totalCredits += $creditHours;
                $totalDays += $courseDays;
                $courseCount++;

                if ($earliestStartDate === null || $startDate < $earliestStartDate) {
                    $earliestStartDate = $startDate;
                }
                if ($latestEndDate === null || $endDate > $latestEndDate) {
                    $latestEndDate = $endDate;
                }
            ?>
                <tr>
                    <td><?= htmlspecialchars($courseName) ?></td>
                    <td><?= $creditHours ?></td>
                    <td><?= $startDate->format('Y-m-d') ?></td>
                    <td><?= $endDate->format('Y-m-d') ?></td>
                    <td><?= $courseDays ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
        $minRequiredCredits = 42;
        $remainingCredits = max(0, $minRequiredCredits - $totalCredits);
        $percentageCompleted = ($totalCredits / $minRequiredCredits) * 100;
        ?>
        <p><strong>Total Credit Hours:</strong> <?= $totalCredits ?></p>
        <p><strong>Number of Courses Attended:</strong> <?= $courseCount ?></p>
        <p><strong>Total Days for All Courses:</strong> <?= $totalDays ?></p>
        <p><strong>Percentage Completed:</strong> <?= number_format($percentageCompleted, 2) ?>%</p>
        <p><strong>Remaining Credit Hours to Pass:</strong> <?= $remainingCredits ?></p>
        <p><strong>Status:</strong> <?= $totalCredits >= $minRequiredCredits ? 'Pass and Met' : 'Do Not Meet' ?> the Minimum Credit Hours Requirement</p>
        <button onclick="printSummary()">Print</button>
    </div>
</body>
</html>
