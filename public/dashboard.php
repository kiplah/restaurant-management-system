<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

// Fetch key metrics
$total_orders = $pdo->query("SELECT COUNT(*) as count FROM Orders")->fetch()['count'];
$total_menu_items = $pdo->query("SELECT COUNT(*) as count FROM MenuItems")->fetch()['count'];
$total_tables = $pdo->query("SELECT COUNT(*) as count FROM Tables")->fetch()['count'];
$total_users = $pdo->query("SELECT COUNT(*) as count FROM Users")->fetch()['count'];

// Fetch recent orders with user names
$recent_orders = $pdo->query("
    SELECT o.*, u.username 
    FROM Orders o 
    LEFT JOIN Users u ON o.user_id = u.user_id 
    ORDER BY o.created_at DESC LIMIT 5
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Restaurant System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background-color: #202124;
            color: white;
            padding-top: 30px;
        }
        .sidebar a {
            color: #ccc;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #333;
            color: #fff;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f4f4f4;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .card h5 {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="text-center mb-4"><i class="bi bi-shop"></i> Restaurant</h3>
        <a href="dashboard.php" class="active"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a href="menu.php"><i class="bi bi-list-ul me-2"></i> Menu</a>
        <a href="orders.php"><i class="bi bi-receipt-cutoff me-2"></i> Orders</a>
        <a href="tables.php"><i class="bi bi-table me-2"></i> Tables</a>
        <a href="users.php"><i class="bi bi-people me-2"></i> Users</a>
        <a href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
    </div>

    <div class="content">
        <h2 class="mb-4">Dashboard Overview</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Total Orders</h5>
                            <p class="fs-4"><?= htmlspecialchars($total_orders) ?></p>
                        </div>
                        <i class="bi bi-receipt fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Menu Items</h5>
                            <p class="fs-4"><?= htmlspecialchars($total_menu_items) ?></p>
                        </div>
                        <i class="bi bi-card-list fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Tables</h5>
                            <p class="fs-4"><?= htmlspecialchars($total_tables) ?></p>
                        </div>
                        <i class="bi bi-table fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>Users</h5>
                            <p class="fs-4"><?= htmlspecialchars($total_users) ?></p>
                        </div>
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-5">Recent Orders</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered bg-white">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total (KSh)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['username']) ?: 'Guest' ?></td>
                        <td>
                            <span class="badge 
                                <?= $order['status'] == 'pending' ? 'bg-secondary' : 
                                     ($order['status'] == 'preparing' ? 'bg-warning text-dark' :
                                     ($order['status'] == 'completed' ? 'bg-success' : 'bg-danger')) ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td>KSh <?= number_format($order['total_amount'], 2) ?></td>
                        <td><?= htmlspecialchars($order['created_at']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
