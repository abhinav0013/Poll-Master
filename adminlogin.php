<?php
session_start();
include('connect.php'); // Include your database connection file

// Handle Admin Login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Sanitize username input
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Sanitize password input

    // Fetch the admin record from the 'admins' table
    $query = "SELECT * FROM admins WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if the username exists in the database
    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);

        // Compare the entered password with the stored plain text password
        if ($password == $admin['password']) {
            // If login is successful, store the admin username in session and redirect
            $_SESSION['admin'] = $username;
            header("Location: admindashboard.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Invalid Username or Password!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid Username or Password!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login and Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="text-center mt-5">Admin Login</h2>

    <!-- Admin Login Form -->
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        <p>don't have an account? <a href="adminregister.php" class="text-primary">Register here</a></p>
    </form>

</div>
</body>
</html>
