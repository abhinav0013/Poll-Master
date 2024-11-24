<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $standard = 'voter';  // We are adding a voter
    
    // Insert voter into the database
    $query = "INSERT INTO userdata (username, password, standard) VALUES ('$username', '$password', '$standard')";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_voters.php");  // Redirect to manage voters page after successful insertion
    } else {
        $error = "Error adding voter: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Add New Voter</h2>
    <form method="POST">
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Voter</button>
    </form>
    <br>
    <a href="manage_voters.php" class="btn btn-secondary">Back to Manage Voters</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
