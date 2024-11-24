<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include('connect.php');

$id = $_GET['id'];  // Get the voter ID from the URL

// Delete the voter
$query = "DELETE FROM userdata WHERE id = '$id' AND standard = 'voter'";
if (mysqli_query($conn, $query)) {
    header("Location: manage_voters.php");  // Redirect to manage voters page after successful deletion
} else {
    echo "Error deleting voter: " . mysqli_error($conn);
}
?>
