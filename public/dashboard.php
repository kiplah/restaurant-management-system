<!-- dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

// Fetch key metrics
$total_orders_stmt = $pdo->query("SELECT COUNT(*) as count FROM Orders");
$total_orders = $total_orders_stmt->fetch()['count'];

$total_menu_items_stmt = $pdo->query("SELECT COUNT(*) as count FROM MenuItems");
$total_menu_items = $total_menu_items_stmt->fetch()['count'];

$total_tables_stmt = $pdo->query("SELECT COUNT(*) as count FROM Tables");
$total_tables = $total_tables_stmt->fetch()['count'];

$total_users_stmt = $pdo->query("SELECT COUNT(*) as count FROM Users");
$total_users = $total_users_stmt->fetch()['count'];

// Fetch recent orders
$recent_orders_stmt = $pdo->query("SELECT * FROM Orders ORDER BY created_at DESC LIMIT 5");
$recent_orders = $recent_orders_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-white text-center">Restaurant Management</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="menu.php">Menu</a>
        <a href="orders.php">Orders</a>
        <a href="tables.php">Tables</a>
        <a href="users.php">Users</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1 class="mt-4">Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text"><?php echo htmlspecialchars($total_orders); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Menu Items</h5>
                        <p class="card-text"><?php echo htmlspecialchars($total_menu_items); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Tables</h5>
                        <p class="card-text"><?php echo htmlspecialchars($total_tables); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo htmlspecialchars($total_users); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <h2>Recent Orders</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
