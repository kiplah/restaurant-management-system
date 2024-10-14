// place_order.php
<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $table_id = $_POST['table_id'];
    $status = 'pending';
    $total_amount = $_POST['total_amount'];

    $stmt = $pdo->prepare("INSERT INTO Orders (user_id, table_id, status, total_amount) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $table_id, $status, $total_amount]);
    
    echo "Order placed successfully!";
}
?>
