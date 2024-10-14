<?php
// place_order.php

include('../includes/db.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_id = $_POST['table_id'];
    $user_id = $_POST['user_id'];
    $total_amount = $_POST['total_amount'];
    
    // Insert new order into the Orders table
    $query = "INSERT INTO Orders (user_id, table_id, total_amount, status) VALUES (:user_id, :table_id, :total_amount, 'pending')";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':table_id', $table_id);
    $stmt->bindParam(':total_amount', $total_amount);
    $stmt->execute();
    
    // Redirect to orders page
    header("Location: orders.php");
    exit;
}

// Fetch menu items for customers to order
$menu_query = "SELECT * FROM MenuItems WHERE is_available = 1";
$menu_items = $pdo->query($menu_query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Place an Order</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="table_id">Table Number:</label>
                <input type="number" name="table_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" name="total_amount" step="0.01" class="form-control" required>
            </div>
            <input type="submit" value="Place Order" class="btn btn-primary">
        </form>
        <a href="orders.php" class="btn btn-secondary mt-2">Back to Orders</a>
    </div>
</body>
</html>
