<?php
include('connect.php');

// Fetch all voters
$votersResult = mysqli_query($conn, "SELECT * FROM userdata WHERE standard = 'voter'");

// Check for verification status in the URL
$verificationMessage = '';
if (isset($_GET['verification'])) {
    if ($_GET['verification'] === 'success') {
        $verificationMessage = '<div class="alert alert-success text-center">Aadhaar Verified Successfully <i class="bi bi-check-circle text-success"></i></div>';
    } elseif ($_GET['verification'] === 'failed') {
        $verificationMessage = '<div class="alert alert-danger text-center">Verification Failed. Please try again.</div>';
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Voters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Voters</h2>

    <!-- Display verification messages -->
    <?php echo $verificationMessage; ?>

    <h4 class="mb-3">Existing Voters</h4>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Mobile</th>
                    <th>Aadhaar</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($votersResult) > 0) {
                    while ($voter = mysqli_fetch_assoc($votersResult)) {
                        $status = $voter['verified'] == 1 
                            ? '<i class="bi bi-check-circle text-success"></i> Verified' 
                            : '<i class="bi bi-x-circle text-danger"></i> Not Verified';

                        echo "<tr>
                            <td>{$voter['id']}</td>
                            <td>{$voter['username']}</td>
                            <td>{$voter['mobile']}</td>
                            <td>{$voter['Aadhar']}</td>
                            <td>{$status}</td>
                            <td>
                                <form action='verify_voter.php' method='POST' class='d-inline'>
                                    <input type='hidden' name='id' value='{$voter['id']}'>
                                    <input type='hidden' name='aadhaar' value='{$voter['Aadhar']}'>
                                    <button type='submit' class='btn btn-primary btn-sm'>Verify Aadhaar</button>
                                </form>
                                <a href='edit_voter.php?id={$voter['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_voter.php?id={$voter['id']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No voters found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
