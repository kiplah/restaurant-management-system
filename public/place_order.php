<!-- place_order.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Place Order</h2>
        <form action="place_order.php" method="POST">
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required>
            </div>
            <div class="form-group">
                <label for="table_id">Table ID:</label>
                <input type="number" class="form-control" id="table_id" name="table_id" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <input type="text" class="form-control" id="total_amount" name="total_amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</body>
</html>
