<?php
include('connect.php');

// Fetch form data
$username = $_POST['username'];
$Aadhar=$_POST['Aadhar'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$image = $_FILES['photo']['name']; 
$tempname = $_FILES['photo']['tmp_name']; 
$std = $_POST['std'];

// Check if passwords match
if ($password != $cpassword) {
    echo '<script>
    alert("Passwords do not match");
    window.location="Registerpage.php";
    </script>';
    exit();
} else {
    // Move the uploaded file to the correct directory
    if (move_uploaded_file($tempname, "../online voting/upload/$image")) {
        // Insert data into the database
        $sql = "INSERT INTO `userdata` (username, Aadhar, mobile, password, photo, standard, status, vote) 
                VALUES ('$username','$Aadhar', '$mobile', '$password', '$image', '$std', 0, 0)";
        
        // Execute the query using the $conn variable
        $result = mysqli_query($conn, $sql);

        // Check if the insertion was successful
        if ($result) {
            echo '<script>
            alert("Registration Successful");
            window.location="index.php";
            </script>';
        } else {
            // Handle query execution failure and display error
            echo '<script>
            alert("Registration Failed: ' . mysqli_error($conn) . '");
            window.location="Registerpage.php";
            </script>';
        }
    } else {
        // Handle file upload failure
        echo '<script>
        alert("File upload failed. Please try again.");
        window.location="Registerpage.php";
        </script>';
    }
}
?>
