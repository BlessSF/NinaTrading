<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'employee_evaluation');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the employee ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Employee ID is required.");
}

$employee_id = intval($_GET['id']);

// Fetch employee details
$sql = "SELECT id, surname, first_name, date_hired FROM employees WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Employee not found.");
}

$employee = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = $_POST['surname'];
    $first_name = $_POST['first_name'];
    $date_hired = $_POST['date_hired'];

    // Update employee details
    $update_sql = "UPDATE employees SET surname = ?, first_name = ?, date_hired = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $surname, $first_name, $date_hired, $employee_id);

    if ($update_stmt->execute()) {
        header("Location: employees.php");
        exit;
    } else {
        echo "Error updating employee: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
      

        h1 {
            text-align: center;
            background-color: #6f42c1;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #0056b3;
        }

   

        
        .logout-button {
            margin-top: 20px;
            background-color: #d9534f;
            color: white;
            text-align: center;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #c12e2a;
        }
    </style>
</head>
<body>
    <!-- Side Navigation -->
    <div class="sidenav">
        <div class="logo-container">
            <img src="images/Logo.jpg" alt="Nina Trading Logo" class="logo">
        </div>
        <a href="index.php">Dashboard</a>
        <a href="employees.php">Probationary Employees</a>
        <a href="upload.php">Upload Employee Data</a>
        <a href="notification.php">Notifications</a>
        <a href="logout.php" class="logout-button">Log Out</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <h1>Edit Employee</h1>
        <form method="POST">
            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" value="<?= htmlspecialchars($employee['surname']) ?>" required>
            
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($employee['first_name']) ?>" required>
            
            <label for="date_hired">Date Hired:</label>
            <input type="date" name="date_hired" id="date_hired" value="<?= htmlspecialchars($employee['date_hired']) ?>" required>
            
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>
