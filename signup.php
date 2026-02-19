<?php
require_once 'db_conn.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. GET USER INPUT DATA
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = 'user'; // Fixed default role: New applicants are always 'user' by default.
    
    // 2. FORM VALIDATION RULES (Adjust these as needed)
    if (strlen($username) < 3) {
        $error = "Username must be at least 3 characters";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } else {
        /* 
            SQL QUERY SETTINGS
            Change 'users', 'username', 'password', 'role' as needed to match your DB table.
        */
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Username already exists";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $username, $hashed, $role);
            
            if (mysqli_stmt_execute($stmt)) {
                // SUCCESSFUL SIGNUP REMINDER
                // This link can be changed to whatever you want after successful registration.
                $success = "Account created! <a href='login.php'>Login here</a>";
            } else {
                $error = "Registration failed";
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <!-- Role selection removed for security. New users default to 'user'. -->
            <button type="submit" class="btn">Sign Up</button>
        </form>
        
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>