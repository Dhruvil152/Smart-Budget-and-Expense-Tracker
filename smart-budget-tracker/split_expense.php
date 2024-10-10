<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = 1; // Example user id
    $categories = $_POST['categories'];
    $amounts = $_POST['amounts'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];

    for ($i = 0; $i < count($categories); $i++) {
        $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, category, amount, date, notes) VALUES (?, 'expense', ?, ?, ?, ?)");
        $stmt->execute([$user_id, $categories[$i], $amounts[$i], $date, $notes]);
    }

    echo "Expense split successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Split Expense</title>
</head>
<body>
    <h1>Split Expense</h1>
    <form method="POST">
        <div id="expense-splitter">
            <label for="date">Date:</label>
            <input type="date" name="date" required><br>

            <label for="notes">Notes:</label>
            <textarea name="notes"></textarea><br>

            <div class="split-group">
                <label for="categories[]">Category:</label>
                <input type="text" name="categories[]" required><br>

                <label for="amounts[]">Amount:</label>
                <input type="number" step="0.01" name="amounts[]" required><br>
            </div>

            <button type="button" onclick="addSplit()">Add Another Split</button><br>

            <button type="submit">Submit</button>
        </div>
    </form>

    <script>
        function addSplit() {
            let splitGroup = document.querySelector('.split-group').cloneNode(true);
            document.querySelector('#expense-splitter').appendChild(splitGroup);
        }
    </script>
</body>
</html>
