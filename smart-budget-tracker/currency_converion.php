<?php
include('includes/db.php');

$user_id = 1; // Example user id
$currency_code = isset($_GET['currency']) ? $_GET['currency'] : 'USD';

// Fetch currency rate
$stmt = $pdo->prepare("SELECT rate FROM currency_rates WHERE currency_code = ?");
$stmt->execute([$currency_code]);
$rate = $stmt->fetchColumn();

// Fetch budgets and convert them
$stmt = $pdo->prepare("SELECT category, amount FROM budgets WHERE user_id = ?");
$stmt->execute([$user_id]);
$budgets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Currency Conversion</title>
</head>
<body>
    <h1>Budget in <?php echo htmlspecialchars($currency_code); ?></h1>
    <form method="GET">
        <label for="currency">Choose Currency:</label>
        <select name="currency" onchange="this.form.submit()">
            <option value="USD" <?php if ($currency_code == 'USD') echo 'selected'; ?>>USD</option>
            <option value="EUR" <?php if ($currency_code == 'EUR') echo 'selected'; ?>>EUR</option>
            <option value="CAD" <?php if ($currency_code == 'CAD') echo 'selected'; ?>>CAD</option>
        </select>
    </form>

    <table border="1">
        <tr>
            <th>Category</th>
            <th>Budget (Converted)</th>
        </tr>
        <?php foreach ($budgets as $budget): ?>
        <tr>
            <td><?php echo htmlspecialchars($budget['category']); ?></td>
            <td><?php echo number_format($budget['amount'] * $rate, 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
