<?php
// Database connection
$dbHost = "localhost";
$dbName = "jkdm";
$dbUser = "root";
$dbPassword = "";
$dbPort = "3307";

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch staff data based on IC Number
if (isset($_POST['icnumber'])) {
    $icnumber = $_POST['icnumber'];

    // Prepare and execute the query
    $sql = "SELECT firstName, lastName, workposition, email, phoneNumber, department 
            FROM jkdmregister WHERE icnumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $icnumber); // "s" indicates the type is string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data from the result
        $row = $result->fetch_assoc();
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $workposition = $row['workposition'];
        $email = $row['email'];
        $phoneNumber = $row['phoneNumber'];
        $department = $row['department'];
    } else {
        echo "No staff found with this IC number.";
        exit;
    }
}
?>
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
        }
        .form-container {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff Information</title>
</head>
<body>
    <div class="header">
        <img src="https://i.pinimg.com/736x/4c/dd/1c/4cdd1cb33d9457d42dc137ed86e04847.jpg" alt="JKDMP">
        <h1>Jabatan Kastam Diraja Malaysia Pahang</h1>
        <nav>
        <a href="javascript:history.back()">BACK</a>

        </nav>
    </div>
    
    <div class="form-container">
    <h2>Update Staff Information</h2>
    
    <form action="processUpdate.php" method="post">
    <div class="form-group">
        <label for="firstName">First Name:</label><br>
        <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>"><br>
    </div>
        
    <div class="form-group">
        <label for="lastName">Last Name:</label><br>
        <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>"><br>
    </div>
        
    <div class="form-group">
        <label for="workposition">Work Position:</label><br>
        <input type="text" id="workposition" name="workposition" value="<?php echo htmlspecialchars($workposition); ?>"><br>
    </div>
        
    <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
    </div>
        
    <div class="form-group">
        <label for="phoneNumber">Phone Number:</label><br>
        <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($phoneNumber); ?>"><br>
    </div>
        
    <div class="form-group">
        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($department); ?>"><br>
    </div>

        <input type="hidden" name="icnumber" value="<?php echo htmlspecialchars($icnumber); ?>">

        <input type="submit" value="Update">
    </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
