<!-- register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../includes/db.php'; // Include database connection

        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $email = $_POST['email'];
        $role = 'customer'; // Default role

        // Check if the user already exists
        $stmt = $pdo->prepare("SELECT user_id FROM Users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            // If the user exists, update the existing record
            $stmt = $pdo->prepare("UPDATE Users SET password = ?, role = ? WHERE user_id = ?");
            $stmt->execute([$password, $role, $existingUser['user_id']]);
            echo "User updated successfully!";
        } else {
            // If the user does not exist, insert a new record
            $stmt = $pdo->prepare("INSERT INTO Users (username, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $password, $email, $role]);
            echo "Registration successful!";
        }
    }
    ?>
</body>
</html>
