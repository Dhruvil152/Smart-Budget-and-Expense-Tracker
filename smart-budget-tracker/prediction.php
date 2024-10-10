<?php
include('includes/db.php');
session_start();

$user_id = $_SESSION['user_id']; // Use the logged-in user ID

// Fetch expenses for each category over the last 3 months
// Assigning weights to each month (Month 1: weight 1, Month 2: weight 2, Month 3: weight 3)
$query = "
    SELECT category,
           SUM(CASE WHEN MONTH(date) = MONTH(CURDATE()) - 2 THEN amount * 1 ELSE 0 END) AS month1,
           SUM(CASE WHEN MONTH(date) = MONTH(CURDATE()) - 1 THEN amount * 2 ELSE 0 END) AS month2,
           SUM(CASE WHEN MONTH(date) = MONTH(CURDATE()) THEN amount * 3 ELSE 0 END) AS month3
    FROM transactions
    WHERE user_id = ? AND type = 'expense'
    AND date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
    GROUP BY category
";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate weighted average for each category
$predictions = [];
foreach ($expenses as $expense) {
    $total_weight = 6; // (1 + 2 + 3)
    $weighted_avg = ($expense['month1'] + $expense['month2'] + $expense['month3']) / $total_weight;
    $predictions[] = [
        'category' => $expense['category'],
        'avg_expenses' => $weighted_avg
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Prediction</title>
</head>
<body>
    <h1>Predicted Future Expenses</h1>
    <table border="1">
        <tr>
            <th>Category</th>
            <th>Predicted Average Expenses (Weighted)</th>
        </tr>
        <?php foreach ($predictions as $prediction): ?>
        <tr>
            <td><?php echo htmlspecialchars($prediction['category']); ?></td>
            <td><?php echo number_format($prediction['avg_expenses'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>