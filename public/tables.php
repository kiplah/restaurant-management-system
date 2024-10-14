<!-- tables.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

// Handle adding a new table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_table'])) {
    $table_number = $_POST['table_number'];
    $seats = $_POST['seats'];

    $stmt = $pdo->prepare("INSERT INTO Tables (table_number, seats) VALUES (?, ?)");
    $stmt->execute([$table_number, $seats]);
}

// Fetch all tables
$stmt = $pdo->query("SELECT * FROM Tables");
$tables = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manage Tables</h2>

        <!-- Add Table Form -->
        <form action="tables.php" method="POST">
            <div class="form-group">
                <label for="table_number">Table Number:</label>
                <input type="number" class="form-control" id="table_number" name="table_number" required>
            </div>
            <div class="form-group">
                <label for="seats">Number of Seats:</label>
                <input type="number" class="form-control" id="seats" name="seats" required>
            </div>
            <button type="submit" name="add_table" class="btn btn-primary">Add Table</button>
        </form>

        <h3>Existing Tables</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Table ID</th>
                    <th>Table Number</th>
                    <th>Seats</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tables as $table): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($table['table_id']); ?></td>
                        <td><?php echo htmlspecialchars($table['table_number']); ?></td>
                        <td><?php echo htmlspecialchars($table['seats']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
