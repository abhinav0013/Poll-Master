<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include('connect.php');

$id = $_GET['id'];  // Get the candidate ID from the URL
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update candidate information
    $query = "UPDATE userdata SET username = '$username', password = '$password' WHERE id = '$id' AND standard = 'group'";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_candidates.php");  // Redirect after successful update
    } else {
        $error = "Error updating candidate: " . mysqli_error($conn);
    }
}

// Fetch candidate data
$query = "SELECT * FROM userdata WHERE id = '$id' AND standard = 'group'";
$result = mysqli_query($conn, $query);
$candidate = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Candidate</h2>
    <form method="POST">
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $candidate['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo $candidate['password']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Candidate</button>
    </form>
    <br>
    <a href="manage_candidates.php" class="btn btn-secondary">Back to Manage Candidates</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
