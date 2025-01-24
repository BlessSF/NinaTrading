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

// Check if the employee ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $employee_id = intval($_GET['id']);

    // Fetch the employee's name before deletion for the message
    $stmt = $conn->prepare("SELECT surname, first_name FROM employees WHERE id = ?");
    $stmt->bind_param('i', $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();
    $stmt->close();

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param('i', $employee_id);

    if ($stmt->execute()) {
        // Set floating notification with employee details
        $_SESSION['floating_message'] = "{$employee['surname']}, {$employee['first_name']} has been successfully deleted.";
    } else {
        $_SESSION['floating_message'] = "Failed to delete employee.";
    }

    $stmt->close();
} else {
    $_SESSION['floating_message'] = "Invalid employee ID.";
}

// Redirect back to employees.php
header('Location: employees.php');
$conn->close();
?>
