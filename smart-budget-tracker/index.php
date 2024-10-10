<?php include('includes/db.php'); ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if (isset($_SESSION['username'])) {
    echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Budget Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php">Logout</a>
        <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
         <?php endif; ?>
        
        <h1>Welcome to Smart Budget and Expense Tracker</h1>
    </header>
    
    <section>
        <h2>Track your budget easily</h2>
        <a href="income_expense.php" class="button">Log Income & Expenses</a>
        <a href="budget.php" class="button">Allocate Budgets</a>
        <a href="report.php" class="button">Generate Monthly Report</a>
        <a href="prediction.php" class="button">Predict Future Expenses</a>
    </section>

    <footer>
        <p>&copy; 2024 Smart Budget Tracker</p>
    </footer>
</body>
</html>
