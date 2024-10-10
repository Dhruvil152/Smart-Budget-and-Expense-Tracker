<?php
include('includes/db.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    // Set alert_threshold to NULL if it is empty
    $alert_threshold = !empty($_POST['alert_threshold']) ? $_POST['alert_threshold'] : NULL;

    // Validate form inputs
    if (!empty($category) && !empty($amount)) {
        try {
            // Insert data into the budgets table
            $stmt = $pdo->prepare("INSERT INTO budgets (user_id, category, amount, alert_threshold) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $user_id);
            $stmt->bindValue(2, $category);
            $stmt->bindValue(3, $amount);
            $stmt->bindValue(4, $alert_threshold, PDO::PARAM_NULL); // Allow NULL for alert_threshold
            $stmt->execute();
            echo "Budget allocated successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Category and amount are required fields.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Allocate Budget</title>
</head>
<body>
    <h1>Allocate Budget</h1>
    <form method="POST">
        <label for="category">Category:</label>
        <input type="text" name="category" required><br>

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" name="amount" required><br>

        <label for="alert_threshold">Alert Threshold (optional):</label>
        <input type="number" step="0.01" name="alert_threshold"><br>

        <button type="submit">Allocate Budget</button>
    </form>
</body>
</html>
