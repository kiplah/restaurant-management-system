// register.php
<?php
include '../includes/db.php'; // Use '../' to go up one directory


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $role = 'customer'; // Default role

    $stmt = $pdo->prepare("INSERT INTO Users (username, password, email, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $email, $role]);
    
    echo "Registration successful!";
}
?> 
