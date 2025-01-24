<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'employee_evaluation');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Fetch employees with "Probation" status
$sql_probation = "SELECT surname, first_name, date_hired, status FROM employees WHERE status = 'Probation'";
$result_probation = $conn->query($sql_probation);

// Count the number of probationary employees
$probation_count = $result_probation->num_rows;

// Fetch the total number of employees
$sql_total = "SELECT COUNT(*) AS total_employees FROM employees";
$result_total = $conn->query($sql_total);

if ($result_total) {
    $total_employees_row = $result_total->fetch_assoc();
    $total_employees = $total_employees_row['total_employees'];
} else {
    $total_employees = 0;
}

// Prepare probation employees list
$probation_employees = [];
if ($result_probation->num_rows > 0) {
    while ($row = $result_probation->fetch_assoc()) {
        $full_name = $row['surname'] . ', ' . $row['first_name'];
        $probation_employees[] = "$full_name (Hired on: {$row['date_hired']})";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Active link style */
        .sidenav a.active {
            background-color: #007bff; /* Blue */
            color: white;
            font-weight: bold;
        }
        .sidenav a:hover {
            background-color: #0056b3; /* Darker blue on hover */
            color: white;
        }
        .logout-button {
            background-color: #d9534f; /* Red */
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            display: block;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .logout-button:hover {
            background-color: #c12e2a; /* Darker red */
            color: white;
        }

        /* Statistics card styling */
        .stats-card {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Align content to the left */
            width: 280px;
            height: 150px;
            margin-top: 20px; /* Place directly below "Statistics" */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left; /* Left-align text */
            font-size: 20px;
            font-weight: bold;
            color: #333;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .stats-card:hover {
            background-color: #007bff; /* Blue */
            color: white;
            transform: translateY(-5px); /* Lift effect */
        }

        .stats-card i {
            margin-right: 10px;
            font-size: 30px;
        }

        .stats-card .number {
            font-size: 40px; /* Increase font size for the number */
            font-weight: bold;
            margin-left: 10px;
        }

        /* Header alignment */
        section h2 {
            text-align: left;
            margin-bottom: 10px;
            color: #333;
        }

        .statistics-section {
            display: flex;
            flex-direction: column; /* Align the heading and card in a column */
            align-items: flex-start; /* Align items to the left */
        }
    </style>
</head>
<body>
    <!-- Side Navigation -->
    <div class="sidenav">
        <div class="logo-container">
            <img src="images/Logo.jpg" alt="Nina Trading Logo" class="logo">
        </div>
        <a href="index.php" class="active">Dashboard</a>
        <a href="employees.php">Probationary Employees</a>
        <a href="regular_employees.php" >Regular Employees</a>
        <a href="upload.php">Upload Employee Data</a>
        <a href="notification.php" >Notifications</a>
        <a href="logout.php" class="logout-button">Log Out</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <header>
            <h1>Employee Evaluation Dashboard</h1>
        </header>
        <section class="statistics-section">
            <h2>Statistics</h2>
            <div class="stats-card" onclick="location.href='employees.php'">
                <i class="fas fa-users"></i>
                <div>
                    Total Employees: <span class="number"><?= $total_employees ?></span>
                    <br>
                 
                </div>
            </div>
        </section>
       
    </div>
</body>
</html>
<?php $conn->close(); ?>
