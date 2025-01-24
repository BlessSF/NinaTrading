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

// Query to fetch employees needing evaluation
$sql = "
    SELECT 
        id, 
        surname, 
        first_name, 
        branch, 
        date_hired,
        CASE
            WHEN TIMESTAMPDIFF(MONTH, date_hired, CURDATE()) >= 12 THEN 
                CONCAT(
                    FLOOR(TIMESTAMPDIFF(MONTH, date_hired, CURDATE()) / 12), 
                    ' year(s)', 
                    CASE 
                        WHEN MOD(TIMESTAMPDIFF(MONTH, date_hired, CURDATE()), 12) > 0 
                        THEN CONCAT(' and ', MOD(TIMESTAMPDIFF(MONTH, date_hired, CURDATE()), 12), ' month(s)') 
                        ELSE '' 
                    END
                )
            ELSE CONCAT(TIMESTAMPDIFF(MONTH, date_hired, CURDATE()), ' month(s)')
        END AS tenure
    FROM employees
    WHERE 
        status = 'Probationary'
        AND TIMESTAMPDIFF(MONTH, date_hired, CURDATE()) >= 3
    ORDER BY date_hired ASC;
";

$result = $conn->query($sql);

// Fetch notifications
$notifications = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Sidebar Styling */
       
    </style>
</head>
<body>
    <div class="sidenav">
    <div class="logo-container">
            <img src="images/Logo.jpg" alt="Nina Trading Logo" class="logo">
        </div>
        <a href="index.php">Dashboard</a>
        <a href="employees.php">Probationary Employees</a>
        <a href="regular_employees.php" >Regular Employees</a>
        <a href="upload.php">Upload Employee Data</a>
        <a href="notification.php" class="active">Notifications</a>
        <a href="logout.php" class="logout-button">Log Out</a>
    </div>

    <div class="main">
        <h1>Notifications</h1>
        <h2>Employees Needing Evaluation</h2>
        <table class="notifications-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Surname</th>
                    <th>First Name</th>
                    <th>Branch</th>
                    <th>Date Hired</th>
                    <th>Tenure</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; ?>
                <?php foreach ($notifications as $notification): ?>
                    <tr>
                        <td><?= $counter++ ?></td>
                        <td><?= htmlspecialchars($notification['surname']) ?></td>
                        <td><?= htmlspecialchars($notification['first_name']) ?></td>
                        <td><?= htmlspecialchars($notification['branch']) ?></td>
                        <td><?= htmlspecialchars($notification['date_hired']) ?></td>
                        <td><?= htmlspecialchars($notification['tenure']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($notifications)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No employees needing evaluation.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>
