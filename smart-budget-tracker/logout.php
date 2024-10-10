<?php if (isset($_SESSION['user_id'])): ?>
    <a href="logout.php">Logout</a>
<?php else: ?>
    <a href="login.php">Login</a> | <a href="register.php">Register</a>
<?php endif; ?>

<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php');
exit;
