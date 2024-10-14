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
    header("Location: orders.php"); // Redirect after adding the order
    exit;
}

// Handle deleting an order
if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $stmt = $pdo->prepare("DELETE FROM Orders WHERE order_id = ?");
    $stmt->execute([$order_id]);
    header("Location: orders.php"); // Redirect after deleting the order
    exit;
}

// Handle updating an order status and log the change
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_order_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    // Fetch current status to log the change
    $stmt = $pdo->prepare("SELECT status FROM Orders WHERE order_id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch();
    $old_status = $order['status'];

    // Update the order status
    $stmt = $pdo->prepare("UPDATE Orders SET status = ? WHERE order_id = ?");
    $stmt->execute([$new_status, $order_id]);

    // Log the status change
    $stmt = $pdo->prepare("INSERT INTO OrderStatusLog (order_id, old_status, new_status) VALUES (?, ?, ?)");
    $stmt->execute([$order_id, $old_status, $new_status]);

    header("Location: orders.php"); // Redirect after updating the order
    exit;
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
    <div class="container mt-4">
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Table ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['table_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td>
                            <form action="orders.php" method="POST" style="display:inline-block;">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" <?php if ($order['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                    <option value="preparing" <?php if ($order['status'] == 'preparing') echo 'selected'; ?>>Preparing</option>
                                    <option value="completed" <?php if ($order['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                    <option value="cancelled" <?php if ($order['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                </select>
                                <input type="hidden" name="update_order_status" value="1">
                            </form>
                        </td>
                        <td>
                            <a href="orders.php?delete_order=<?php echo $order['order_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Order Status History</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Old Status</th>
                    <th>New Status</th>
                    <th>Changed At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch the order status history
                $statusLogStmt = $pdo->query("SELECT * FROM OrderStatusLog ORDER BY changed_at DESC");
                $statusLogs = $statusLogStmt->fetchAll();
                foreach ($statusLogs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($log['old_status']); ?></td>
                        <td><?php echo htmlspecialchars($log['new_status']); ?></td>
                        <td><?php echo htmlspecialchars($log['changed_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
