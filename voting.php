<?php
session_start();
include('connect.php');
//include('dashboard.php');

// Get the vote and group id from POST
$vote = $_POST['groupvote'];
$totalvote = $vote + 1;
$gid = $_POST['groupid'];
$uid = $_SESSION['id'];

// Update the vote for the group
$updatevote = mysqli_query($conn, "UPDATE `userdata` SET vote='$totalvote' WHERE id='$gid'");

// Update the status for the user
$updatestatus = mysqli_query($conn, "UPDATE `userdata` SET status=1 WHERE id='$uid'");

// Check if both queries were successful
if($updatevote && $updatestatus) {
    // Fetch group data
    $getgroup = mysqli_query($conn, "SELECT username, photo, vote, id FROM `userdata` WHERE standard='group'");
    $group = mysqli_fetch_all($getgroup, MYSQLI_ASSOC);

    // Store group data and status in session
    $_SESSION['group'] = $group;
    $_SESSION['status'] = 1;

    // Redirect with success message
    echo '<script>
        alert("Voting successful");
        window.location = "../online voting/dashboard.php";
    </script>';

} else {
    // Redirect with error message
    echo '<script>
        alert("Technical error! Please try again.");
        window.location = "dashboard.php";
    </script>';
}
?>
