<?php
session_start();
include('connect.php'); // Include your database connection file

// Handle Admin Registration (Insertion)
if (isset($_POST['register'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password']; // Plain text password

    // SQL Insert Query to store the username and password in the database
    $insertQuery = "INSERT INTO admins (username, password) VALUES ('$newUsername', '$newPassword')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo '<script>
                window.location="adminlogin.php"; // Redirect to the login page after successful registration
              </script>';
    } else {
        echo "<div class='alert alert-danger'>Error adding admin: " . mysqli_error($conn) . "</div>";
    }
}
?>





<!-- Admin Registration Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin  Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h2 class="text-center mt-5">Admin Register</h2>
<form method="POST" class="mt-3">
        <div class="mb-3">
            <input type="text" name="new_username" class="form-control" placeholder="New Username" required>
        </div>
        <div class="mb-3">
            <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
        </div>
        <button type="submit" name="register" class="btn btn-success w-100">Register</button>
        <p>Already have an account? <a href="adminlogin.php" class="text-primary">Login here</a></p>
    </form>
    

</div>
</body>
</html>

