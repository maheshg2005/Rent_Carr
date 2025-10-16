<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo "<script>alert('Login successful!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="auth-page">

<div class="container">
    <h1 class="system-heading text-center">Rental Vehicle System</h1>
    <div class="auth-card">
        <h2 class="text-center">Login</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-success btn-custom">Login</button>
        </form>
        <p class="text-link">Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>

</body>
</html>
