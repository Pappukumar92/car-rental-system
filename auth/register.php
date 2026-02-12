<?php
include("../config/db.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name,email,password,role) 
            VALUES ('$name','$email','$password','$role')";

    if($conn->query($sql)){
        echo "Registration Successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="card shadow p-4" style="width: 380px;">
        <h3 class="text-center mb-3">📝 Create Account</h3>

        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

            <select name="role" class="form-select mb-3">
                <option value="customer">Customer</option>
                <option value="agency">Car Agency</option>
            </select>

            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
        </form>

        <p class="text-center mt-3">
            Already have account?
            <a href="login.php">Login</a>
        </p>
    </div>

</body>

</html>