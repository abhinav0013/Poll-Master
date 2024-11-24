<?php
include('connect.php');
session_start();  // Start the session

// Fetch form data
$username = $_POST['username'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$std = $_POST['std'];

// Correct the SQL query with proper backticks and spaces
$sql = "SELECT * FROM `userdata` WHERE username='$username' AND mobile='$mobile' AND password='$password' AND standard='$std'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch groups based on standard 'group'
    $sql = "SELECT username, photo, vote, id FROM `userdata` WHERE standard='group'";
    $resultgroup = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($resultgroup) > 0) {
        $groups = mysqli_fetch_all($resultgroup, MYSQLI_ASSOC);
        $_SESSION['groups'] = $groups;  // Store groups in session
    }

    // Fetch the user's data
    $data = mysqli_fetch_array($result);
    $_SESSION['id'] = $data['id'];
    $_SESSION['status'] = $data['status'];
    $_SESSION['data'] = $data;

    // Redirect to dashboard
    echo '<script>
    window.location="dashboard.php";
    </script>';

} else {
    // If credentials are invalid
    echo '<script>
    alert("Invalid credentials");
    window.location="../";
    </script>';
}
?>