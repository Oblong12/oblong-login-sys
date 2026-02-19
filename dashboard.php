<?php
require_once 'db_conn.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <p>Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
        <p>Your Role: <?php echo htmlspecialchars($role); ?></p>
        
        <?php if ($role === 'manager'): ?>
            <div style="margin: 1rem 0; padding: 10px; background: #e9ecef; border-radius: 4px;">
                <p><strong>Admin Controls:</strong></p>
                <a href="management.php" class="btn" style="background-color: #28a745;">Go to Manager Portal</a>
            </div>
        <?php endif; ?>
        
        <div style="margin-top: 2rem;">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
