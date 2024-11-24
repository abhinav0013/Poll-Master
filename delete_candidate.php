<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include('connect.php');

$id = $_GET['id'];  // Get the candidate ID from the URL

// Delete the candidate
$query = "DELETE FROM userdata WHERE id = '$id' AND standard = 'group'";
if (mysqli_query($conn, $query)) {
    header("Location: manage_candidates.php");  // Redirect to manage candidates page after successful deletion
} else {
    echo "Error deleting candidate: " . mysqli_error($conn);
}
?>
