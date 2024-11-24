<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $aadhaar = $_POST['aadhaar'];

    // Validate Aadhaar format
    $isValidAadhaar = preg_match('/^\d{12}$/', $aadhaar); // Aadhaar must be 12 digits

    if ($isValidAadhaar) {
        // Mark the voter as verified in the database
        $updateQuery = "UPDATE userdata SET verified = 1 WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);

        // Debug prepare() errors
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>
                window.location.href = 'manage_voters.php?verification=success&id=$id';
            </script>";
        } else {
            echo "<script>
                window.location.href = 'manage_voters.php?verification=failed';
            </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
            window.location.href = 'manage_voters.php?verification=invalid';
        </script>";
    }
}
?>
