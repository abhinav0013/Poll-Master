<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="bg-dark">
    <h1 class="text-info text-center p-3">Voting System</h1>
    <div class="bg-info py-4"><!-- padding top and buttom-->
        <h2 class="text-center">Register Account</h2>
        <div class="container text-center">
            <form action="../online voting/Register.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3"> <!-- margin Buttom-->
                    <input type="text" name ="username" class="form-control w-50 m-auto" placeholder="Enter Your User Name" required="required">
                </div>
                <div class="mb-3"> <!-- margin Buttom-->
                    <input type="text" name ="Aadhar" class="form-control w-50 m-auto" placeholder="Enter Your Aadhar No" required="required"  maxLength="12" pattern="\d{12}">
                </div>
                <div class="mb-3">
                    <input type="text" name ="mobile" class="form-control w-50 m-auto" placeholder="Enter Your Mobile Number" required="required" maxLength="10" minLength="10">
                </div>
               
                <div class="mb-3">
                 <input type="password" name ="password" class="form-control w-50 m-auto" placeholder="Enter Your Password" required="required">
                </div>
                <div class="mb-3">
                 <input type="password" name ="cpassword" class="form-control w-50 m-auto" placeholder="Enter Your Confirm Password" required="required">
                </div>
                <div class="mb-3">
                 <input type="file" name ="photo" class="form-control w-50 m-auto">
                </div>
                <div class="mb-3">
                    <select name="std"  class="form-select w-50 m-auto" >
                        <option value="Group">Party</option>
                        <option value="Voter">Voter</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark my-4">Register</button>
                <p>Already have an account? <a href="index.php" class="text-white">Login here</a></p>
            </form> 
        </div>
    </div>    
    
</body>
</html>