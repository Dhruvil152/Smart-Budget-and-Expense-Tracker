<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Use the logged-in user ID
    $type = $_POST['type'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];

    // Validate and insert data
    if (!empty($type) && !empty($category) && !empty($amount) && !empty($date)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, category, amount, date, notes) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $type, $category, $amount, $date, $notes]);
            echo "Transaction logged successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Income and Expense</title>
</head>
<body>
    <h1>Log Income & Expenses</h1>
    <form method="POST">
        <label for="type">Type:</label>
        <select name="type" required>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select><br>

        <label for="category">Category:</label>
        <input type="text" name="category" required><br>

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" name="amount" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <label for="notes">Notes:</label>
        <textarea name="notes"></textarea><br>

        <button type="submit">Log Transaction</button>
    </form>
</body>
</html>
