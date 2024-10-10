<?php
include('includes/db.php');

$user_id = 1; // Example user id

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $notes = $_POST['notes'];

    $stmt = $pdo->prepare("UPDATE transactions SET notes = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$notes, $transaction_id, $user_id]);

    echo "Notes updated successfully!";
}

// Fetch transactions
$stmt = $pdo->prepare("SELECT id, category, amount, notes FROM transactions WHERE user_id = ?");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction Notes</title>
</head>
<body>
    <h1>Add Notes to Transactions</h1>
    <form method="POST">
        <label for="transaction_id">Select Transaction:</label>
        <select name="transaction_id">
            <?php foreach ($transactions as $transaction): ?>
            <option value="<?php echo $transaction['id']; ?>">
                <?php echo htmlspecialchars($transaction['category']) . ' - $' . number_format($transaction['amount'], 2); ?>
            </option>
            <?php endforeach; ?>
        </select><br>

        <label for="notes">Notes:</label>
        <textarea name="notes"></textarea><br>

        <button type="submit">Update Notes</button>
    </form>
</body>
</html>
