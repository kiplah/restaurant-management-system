<!-- orders.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

// Handle adding a new order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_order'])) {
    $user_id = $_SESSION['user_id'];
    $table_id = $_POST['table_id'];
    $total_amount = $_POST['total_amount'];
    $status = 'pending'; // Default status

    $stmt = $pdo->prepare("INSERT INTO Orders (user_id, table_id, total_amount, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $table_id, $total_amount, $status]);
}

// Fetch all orders
$stmt = $pdo->query("SELECT * FROM Orders");
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manage Orders</h2>

        <!-- Add Order Form -->
        <form action="orders.php" method="POST">
            <div class="form-group">
                <label for="table_id">Table ID:</label>
                <input type="number" class="form-control" id="table_id" name="table_id" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
            </div>
            <button type="submit" name="add_order" class="btn btn-primary">Add Order</button>
        </form>

        <h3>Orders</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Table ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['table_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
