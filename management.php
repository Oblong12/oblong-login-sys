<?php
require_once 'db_conn.php';

// Check if user is logged in AND has manager role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'manager') {
    die("Access Denied: You must be a manager to view this page.");
}

$success = '';
$error = '';

// Handle Role Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_role'])) {
    $target_user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];
    
    $stmt = mysqli_prepare($conn, "UPDATE users SET role = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $new_role, $target_user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $success = "User role updated successfully!";
    } else {
        $error = "Failed to update user role.";
    }
    mysqli_stmt_close($stmt);
}

// Fetch all users
$result = mysqli_query($conn, "SELECT id, username, role FROM users ORDER BY username ASC");
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Portal</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .portal-container { width: 500px; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        select { padding: 0.25rem; }
    </style>
</head>
<body>
    <div class="container portal-container">
        <h2>Manager Portal</h2>
        
        <?php if ($success): ?><p class="success"><?php echo $success; ?></p><?php endif; ?>
        <?php if ($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['username']); ?></td>
                        <form method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                            <td>
                                <select name="new_role">
                                    <option value="user" <?php echo $u['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                    <option value="staff" <?php echo $u['role'] == 'staff' ? 'selected' : ''; ?>>Staff</option>
                                    <option value="manager" <?php echo $u['role'] == 'manager' ? 'selected' : ''; ?>>Manager</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="update_role" class="btn" style="padding: 5px; font-size: 0.8rem;">Change</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
