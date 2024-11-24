<?php
include('connect.php'); // Ensure 'connect.php' correctly connects to your database

// Fetch group-wise vote counts
$groupVotesResult = mysqli_query($conn, "
    SELECT username, SUM(vote) AS total_votes 
    FROM userdata 
    WHERE standard = 'group' 
    GROUP BY username
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Election Results</h2>

    <h4 class="mb-3">Group-Wise Vote Count</h4>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Group Name</th>
                    <th>Total Votes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($groupVotesResult) > 0) {
                    while ($group = mysqli_fetch_assoc($groupVotesResult)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($group['username']) . "</td>
                            <td>" . htmlspecialchars($group['total_votes']) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No votes recorded for any group</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
