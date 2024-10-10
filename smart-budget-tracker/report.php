<?php
include('includes/db.php');

$user_id = 1; // Example user id

// Fetch transactions for the current month
$current_month = date('Y-m');
$stmt = $pdo->prepare("SELECT category, SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) AS total_income, 
                      SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) AS total_expenses 
                      FROM transactions 
                      WHERE user_id = ? AND DATE_FORMAT(date, '%Y-%m') = ? 
                      GROUP BY category");
$stmt->execute([$user_id, $current_month]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch allocated budgets
$stmt = $pdo->prepare("SELECT category, amount FROM budgets WHERE user_id = ?");
$stmt->execute([$user_id]);
$budgets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$budget_map = [];
foreach ($budgets as $budget) {
    $budget_map[$budget['category']] = $budget['amount'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report</title>
</head>
<body>
    <h1>Monthly Report for <?php echo date('F Y'); ?></h1>
    <table border="1">
        <tr>
            <th>Category</th>
            <th>Total Income</th>
            <th>Total Expenses</th>
            <th>Budget</th>
            <th>Overbudget</th>
        </tr>
        <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?php echo htmlspecialchars($transaction['category']); ?></td>
            <td><?php echo number_format($transaction['total_income'], 2); ?></td>
            <td><?php echo number_format($transaction['total_expenses'], 2); ?></td>
            <td><?php echo isset($budget_map[$transaction['category']]) ? number_format($budget_map[$transaction['category']], 2) : 'N/A'; ?></td>
            <td>
                <?php
                $overbudget = isset($budget_map[$transaction['category']]) && $transaction['total_expenses'] > $budget_map[$transaction['category']];
                echo $overbudget ? 'Yes' : 'No';
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
