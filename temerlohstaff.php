<?php
// Database connection details
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root";
$dbPassword = "";
$dbPort = "3307";

// Create a PDO connection
try {
    $conn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// SQL query to fetch staff from TEMERLOH department
$sql = "SELECT firstName, lastName, workposition, icnumber, email, phoneNumber, department
        FROM jkdmregister
        WHERE department = 'TEMERLOH'
        ORDER BY department,
        CASE
            WHEN workposition LIKE 'WK%' THEN 1
            WHEN workposition LIKE 'N%' THEN 2
            WHEN workposition LIKE 'H%' THEN 3
            ELSE 4
        END,
        CAST(SUBSTRING(workposition, 3) AS UNSIGNED) DESC";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->execute();

// Fetch all results
$staffList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
<head>
    <title>Staff List</title>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gugi&display=swap">
        <nav>
            <a href="staffdepartment.php">BACK</a>
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

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0f7fa;
        }

        .update-button, .delete-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .update-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: red;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: bold;
        }

        .delete-button:hover {
            background-color: darkred;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .button-container form {
            display: inline-block;
        }

        .button-container form input[type="submit"] {
            margin-left: 10px;
        }

        .confirmation-message {
            text-align: center;
            font-size: 20px;
            color: green;
            margin-top: 20px;
        }

        .error-message {
            text-align: center;
            font-size: 20px;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>TEMERLOH Staff List</h2>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Work Position</th>
                <th>IC Number</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffList as $staff): ?>
                <tr>
                    <td><?php echo htmlspecialchars($staff['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($staff['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($staff['workposition']); ?></td>
                    <td><?php echo htmlspecialchars($staff['icnumber']); ?></td>
                    <td><?php echo htmlspecialchars($staff['email']); ?></td>
                    <td><?php echo htmlspecialchars($staff['phoneNumber']); ?></td>
                    <td><?php echo htmlspecialchars($staff['department']); ?></td>
                    <td>
                        <form action="updateStaff.php" method="post" style="display:inline;">
                            <input type="hidden" name="icnumber" value="<?php echo $staff['icnumber']; ?>">
                            <input type="submit" class="update-button" value="Update">
                        </form>
                        <form action="deleteemployee.php" method="post" style="display:inline;">
                            <input type="hidden" name="icnumber" value="<?php echo $staff['icnumber']; ?>">
                            <input type="submit" class="delete-button" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn = null;
?>
