<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include('connect.php');

// Fetch statistics
$totalVotersResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM userdata WHERE standard = 'voter'");
$totalVoters = mysqli_fetch_array($totalVotersResult)['total'] ?? 0;

$totalCandidatesResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM userdata WHERE standard = 'group'");
$totalCandidates = mysqli_fetch_array($totalCandidatesResult)['total'] ?? 0;

$totalVotesResult = mysqli_query($conn, "SELECT SUM(vote) as total FROM userdata WHERE standard = 'group'");
$totalVotes = mysqli_fetch_array($totalVotesResult)['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            border-radius: 20px;
        }
        .table-responsive {
            max-height: 300px;
            overflow-y: auto;
        }
        .admin-photo {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .dashboard-title {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5 text-center">
    <img src="./upload/abhinav.png" alt="Admin Photo" class="admin-photo">
    <h2 class="dashboard-title text-center mb-4">Admin Dashboard</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Voters</h5>
                    <h3><?php echo $totalVoters; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Candidates</h5>
                    <h3><?php echo $totalCandidates; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Total Votes</h5>
                    <h3><?php echo $totalVotes; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="view_results.php" class="btn btn-info btn-custom me-2">View Results</a>
        <a href="manage_candidates.php" class="btn btn-success btn-custom me-2">Manage Candidates</a>
        <a href="manage_voters.php" class="btn btn-primary btn-custom me-2">Manage Voters</a>
        <a href="adminlogin.php" class="btn btn-danger btn-custom">Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
