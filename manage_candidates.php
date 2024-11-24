<?php
include('connect.php');

// Fetch all candidates
$candidatesResult = mysqli_query($conn, "SELECT * FROM userdata WHERE standard = 'group'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Candidates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Candidates</h2>

    <h4 class="mb-3">Existing Candidates</h4>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($candidatesResult) > 0) {
                    while ($candidate = mysqli_fetch_assoc($candidatesResult)) {
                        echo "<tr>
                            <td>{$candidate['id']}</td>
                            <td>{$candidate['username']}</td>
                            <td>
                                <a href='edit_candidate.php?id={$candidate['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_candidate.php?id={$candidate['id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No candidates found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <a href="add_candidate.php" class="btn btn-primary">Add New Candidate</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
