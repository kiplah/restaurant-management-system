<!-- menu.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../includes/db.php';

// Handle adding a new menu item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_menu_item'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $is_available = isset($_POST['is_available']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO MenuItems (name, description, price, category, is_available) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $category, $is_available]);
}

// Handle deleting a menu item
if (isset($_GET['delete'])) {
    $item_id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM MenuItems WHERE item_id = ?");
    $stmt->execute([$item_id]);
}

// Handle updating a menu item
if (isset($_POST['update_menu_item'])) {
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $is_available = isset($_POST['is_available']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE MenuItems SET name = ?, description = ?, price = ?, category = ?, is_available = ? WHERE item_id = ?");
    $stmt->execute([$name, $description, $price, $category, $is_available, $item_id]);
}

// Fetch all menu items
$stmt = $pdo->query("SELECT * FROM MenuItems");
$menu_items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu Items</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manage Menu Items</h2>

        <!-- Add Menu Item Form -->
        <form action="menu.php" method="POST">
            <div class="form-group">
                <label for="name">Item Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="is_available" name="is_available" checked>
                <label class="form-check-label" for="is_available">Available</label>
            </div>
            <button type="submit" name="add_menu_item" class="btn btn-primary">Add Menu Item</button>
        </form>

        <h3>Menu Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menu_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['item_id']); ?></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['category']); ?></td>
                        <td><?php echo $item['is_available'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="menu.php?edit=<?php echo $item['item_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="menu.php?delete=<?php echo $item['item_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
    // Handle Edit Form if editing a menu item
    if (isset($_GET['edit'])) {
        $item_id = $_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM MenuItems WHERE item_id = ?");
        $stmt->execute([$item_id]);
        $item = $stmt->fetch();
    ?>
        <!-- Edit Menu Item Form -->
        <div class="container">
            <h3>Edit Menu Item</h3>
            <form action="menu.php" method="POST">
                <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                <div class="form-group">
                    <label for="name">Item Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($item['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($item['category']); ?>">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="is_available" name="is_available" <?php echo $item['is_available'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="is_available">Available</label>
                </div>
                <button type="submit" name="update_menu_item" class="btn btn-primary">Update Menu Item</button>
            </form>
        </div>
    <?php } ?>
</body>
</html>
