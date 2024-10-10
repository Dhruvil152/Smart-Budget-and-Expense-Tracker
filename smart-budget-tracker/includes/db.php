<?php
$host = 'localhost';
$dbname = 'budget_tracker'; // Ensure this matches your actual database name
$username = 'root'; // Change this if you have set a different MySQL username
$password = ''; // Change this if you have set a MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
