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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = trim($_POST['surname']);
    $first_name = trim($_POST['first_name']);
    $date_hired = $_POST['date_hired'];
    $status = $_POST['status'];
    $branch = $_POST['branch'];

    if (!empty($surname) && !empty($first_name) && !empty($date_hired) && !empty($status) && !empty($branch)) {
        $stmt = $conn->prepare("INSERT INTO employees (surname, first_name, date_hired, status, branch) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $surname, $first_name, $date_hired, $status, $branch);

        if ($stmt->execute()) {
            $_SESSION['floating_message'] = "Employee {$surname}, {$first_name} added successfully!";
            header('Location: employees.php');
            exit;
        } else {
            $error_message = "Failed to add employee. Please try again.";
        }
        $stmt->close();
    } else {
        $error_message = "All fields are required!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Side Navigation */
        .sidenav a.active {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .sidenav a:hover {
            background-color: #0056b3;
            color: white;
        }

        /* Main Content */
        .main {
            margin-left: 260px;
            padding: 20px;
        }

        /* Form Styling */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        /* Floating Notification */
        .floating-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #d9534f;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .floating-notification button {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Side Navigation -->
    <div class="sidenav">
    <div class="logo-container">
        <img src="images/Logo.jpg" alt="Nina Trading Logo" class="logo">
    </div>
    <a href="index.php" >Dashboard</a>
    <a href="employees.php">Probationary Employees</a>
    <a href="upload.php">Upload Employee Data</a>
    <a href="notification.php" class="active">Notifications</a>
    <a href="logout.php" class="logout-button">Log Out</a>
</div>


    <!-- Main Content -->
    <div class="main">
        <header>
            <h1>Add New Employee</h1>
        </header>
        <section>
            <div class="form-container">
                <h2>Add Employee</h2>
                <?php if (isset($error_message)): ?>
                    <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
                <?php endif; ?>
                <form action="add_employee.php" method="post">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" required>

                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" required>

                    <label for="date_hired">Date Hired</label>
                    <input type="date" name="date_hired" id="date_hired" required>

                    <label for="status">Employment Status</label>
                    <select name="status" id="status" required>
                        <option value="Probationary">Probationary</option>
                        <option value="Regular">Regular</option>
                    </select>

                    <label for="branch">Branch</label>
                    <select name="branch" id="branch" required>
                        <option value="STELLA">STELLA</option>
                        <option value="DOIS">DOIS</option>
                        <option value="PUB">PUB</option>
                    </select>

                    <button type="submit">Add Employee</button>
                </form>
            </div>
        </section>
    </div>

    <!-- Floating Notification -->
    <?php if (isset($_SESSION['floating_message'])): ?>
        <div class="floating-notification">
            <?= htmlspecialchars($_SESSION['floating_message']) ?>
            <button onclick="document.querySelector('.floating-notification').style.display='none';">X</button>
        </div>
        <?php unset($_SESSION['floating_message']); ?>
    <?php endif; ?>
</body>
</html>
