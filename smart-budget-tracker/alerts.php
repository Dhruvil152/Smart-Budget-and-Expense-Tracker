<?php
include('includes/db.php');

$user_id = 1; // Example user id

// Fetch total expenses and budget allocation
$stmt = $pdo->prepare("SELECT b.category, b.amount AS budget, b.alert_threshold, 
                      SUM(CASE WHEN t.type = 'expense' THEN t.amount ELSE 0 END) AS total_spent 
                      FROM budgets b
                      LEFT JOIN transactions t ON b.user_id = t.user_id AND b.category = t.category
                      WHERE b.user_id = ?
                      GROUP BY b.category");
$stmt->execute([$user_id]);
$budgets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Budget Alerts</title>
</head>
<body>
    <h1>Budget Alerts</h1>
    <ul>
        <?php foreach ($budgets as $budget): ?>
        <li>
            <?php
            $remaining_budget = $budget['budget'] - $budget['total_spent'];
            if ($remaining_budget <= $budget['alert_threshold']) {
                echo "Alert: You are nearing your budget limit for " . htmlspecialchars($budget['category']) . "!";
            } else {
                echo "No alerts for " . htmlspecialchars($budget['category']) . ".";
            }
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
